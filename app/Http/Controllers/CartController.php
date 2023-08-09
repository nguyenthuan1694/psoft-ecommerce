<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Courier;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use App\Models\Ward;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
// use Vanthao03596\HCVN\Models\City;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\District\DistrictRepository;
use App\Repositories\Ward\WardRepository;
use App\Events\PusherEventOrders;

class CartController extends Controller
{
    /**
     * @var CategoryRepositoryInterface|\App\Repositories\Repository
    */

    protected $categoryRepository;

    /**
     * @var ProductRepositoryInterface|\App\Repositories\Repository
    */
    protected $productRepository;

    /**
     * @var ProvinceRepositoryInterface|\App\Repositories\Repository
    */
    protected $districtRepository;

    /**
     * @var DistrictRepositoryInterface|\App\Repositories\Repository
    */
    protected $wardRepository;

    /**
     * @var WardRepositoryInterface|\App\Repositories\Repository
    */
    protected $provinceRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        ProvinceRepository $provinceRepository,
        DistrictRepository $districtRepository,
        WardRepository $wardRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->provinceRepository = $provinceRepository;
        $this->districtRepository = $districtRepository;
        $this->wardRepository = $wardRepository;
    }

    /**
     * Show the cart
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $categories = Category::root()->get();
        $product = $this->productRepository->getProuctById($request->product_id);
        $products = $this->categoryRepository->getCategory();
        // $coupon = session()->get('coupon')['name'];
        // $discount = number_format(session()->get('coupon')['discount'], 0) ?? 0;
        $newSubtotal = number_format(round((float) str_replace(',', '', Cart::subtotal()) - 0), 0);

        return view('frontend.cart')
            ->with([
                'categories' => $categories,
                'coupon' => 'abc',
                'discount' => 0,
                'newSubtotal' => $newSubtotal,
                'product' => $product,
            ]);
    }
    

    public function paymentProduct(Request $request)
    {
        $provinces = $this->provinceRepository->getProvinceOrderByName();
        $districts = $this->districtRepository->getDistrictById();
        $wards = $this->wardRepository->getWardById();

        // $product = $this->productRepository->getProductBySlug($request->slug);
        $categories = $this->categoryRepository->getCategory();
        // $coupon = session()->get('coupon')['name'];
        // $discount = number_format(session()->get('coupon')['discount'], 0) ?? 0;
        $discount = 0;
        $newSubtotal = number_format(round((float) str_replace(',', '', Cart::subtotal()) - str_replace(',', '', $discount)), 0);
        return view('frontend.cart.cart_order')
        ->with([
            'categories' => $categories,
            'coupon' => 0,
            'discount' => 0,
            'newSubtotal' => $newSubtotal,
            // 'product' => $product,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
        ]);
    }


    public function payment(Request $request)
    {
        $product = $this->productRepository->getProuctById($request->product_id);
        return view('frontend.payment')
                ->with('product', $product)
        ;
    }

    /**
     * Add product to cart
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request)
    {
        $productId = $request->get('product_id');
        $qty = $request->get('qty') ?? 1;
        $product = $this->productRepository->findProductById($productId);
        Cart::add([
            'id' => $productId,
            'name' => $product->name,
            'qty'  => $qty,
            'price' => $product->price,
            'weight' => $product->weight ?? 0,
            'options' => [
                'img' => asset('../storage/app/'.$product->thumbnail),
                'sku' => $product->sku,
                'stock' => $product->stock ?? 0,
            ]
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Add success',
            'data' => [
                'count' => Cart::count(),
                'content' => Cart::content()->flatten(1)->all(),
                'total' => Cart::total(),
            ],
        ]);
    }

    /**
     * Remove product from cart
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function remove(Request $request)
    {
        $rowId = $request->get('row_id');
        Cart::remove($rowId);
        return response()->json([
            'status' => 200,
            'message' => 'Add success',
            'data' => [
                'count' => Cart::count(),
                'content' => Cart::content()->flatten(1)->all(),
                'total' => Cart::total(),
            ],
        ]);
    }

    /**
     * Update quantity of product in cart
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $rowId = $request->get('row_id');
        $qty = $request->get('qty');

        Cart::update($rowId, $qty);
        return response()->json([
            'status' => 200,
            'message' => 'Add success',
            'data' => [
                'count' => Cart::count(),
                'content' => Cart::content()->flatten(1)->all(),
                'total' => Cart::total(),
            ],
        ]);
    }

    /**
     * Show the checkout page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getCheckout()
    {
        $cart = Cart::content();
        $discount = 0;
        $tax = 0;
        $subTotal = (float) str_replace(',', '', Cart::subtotal());
        $total = round($subTotal - $discount + $tax);
        $provinces = Province::orderBy('name')->get();
        $districts = District::where('parent_code', '01')->orderBy('name')->get();
        $wards = Ward::where('parent_code', '01')->orderBy('name')->get();

        if ($cart->count() > 0) {
            return view('frontend.checkout')
                ->with([
                    'discount' => $discount,
                    'tax' => $tax,
                    'subTotal' => $subTotal,
                    'total' => $total,
                    'provinces' => $provinces,
                    'districts' => $districts,
                    'wards' => $wards,
                ]);
        }

        return redirect()->route('home');
    }

    /**
     * Checkout the order
     *
     * @param CheckoutRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCheckout(CheckoutRequest $request)
    {
        $cartInfo = Cart::content();
        // $coupon = Coupon::where('code', session()->get('coupon')['name'])->first();
        // $discount = isset($coupon) ? $coupon->discount(Cart::subtotal()) : 0;

        $courier = Courier::where('province_code', $request->province_code)->where('district_code', $request->district_code)->first();
        $shipping = $courier->amount ?? config('common.shipping.default_fee');

        // $provinces = $this->provinceRepository->getProvinceOrderByName();
        // $districts = $this->districtRepository->getDistrictById();
        $wards = $this->wardRepository->getWardByCode($request->ward_code);
        $district = $this->districtRepository->getDistrictByCode($request->district_code);
        $province = $this->provinceRepository->getProvinceByCode($request->province_code);
        $address = "{$request->house_number}, {$wards}, {$district}, {$province}";

        $order = Order::create([
            'fullname' => $request->get('fullname'),
            'address' => $address,
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'coupon_id' => 0,
            'discount' =>  0,
            'shipping' => $shipping,
            'subtotal' => str_replace(',', '', Cart::subtotal()),
            'total' => str_replace(',', '', Cart::total()),
            'balance' => str_replace(',', '', Cart::total()),
            'payment_method_id' => $request->payment ?? 1,
            'status' => config('common.order.status.ordered'),
            'note' => $request->get('note'),
        ]);

        if (count($cartInfo) > 0) {
            foreach ($cartInfo as $key => $item) {
                $orderDetail = OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'name' => $item->name,
                    'quantity' => $item->qty,
                    'sku' => $item->options['sku'],
                    'price' => $item->price,
                    'total_price' => $item->price * $item->qty
                ]);
            }
        } 

        Cart::destroy();
        // session()->forget('coupon');
        // if ($coupon instanceof Coupon) {
        //     $coupon->update(['status' => config('common.coupon.status.used')]);
        // }
        event(new PusherEventOrders('Bạn có 1 đơn hàng từ '.$request->get('fullname')));
        return redirect()->route('home')->with('success', 'You have successfully ordered');
    }

    /**
     * Apply coupon for cart
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon instanceof Coupon) {
            return redirect()->route('cart.index')->withErrors('Invalid coupon code. Please try again.');
        }

        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => $coupon->discount(Cart::subtotal())
        ]);

        return redirect()->route('cart.index')->with('success_message', 'Coupon has been applied!');
    }

    /**
     * Remove coupon from cart
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeCoupon(Request $request)
    {
        session()->forget('coupon');
        return redirect()->route('cart.index')->with('success_message', 'Coupon has been removed!');
    }

    public function getListDistrict(Request $request)
    {
        $provinceCode = $request->get('provinceCode');

        $districts = District::where('parent_code', $provinceCode)->orderBy('name')->get();

        return response()->json(['data' => $districts]);
    }

    public function getListWard(Request $request)
    {
        $districtCode = $request->get('districtCode');

        $wards = Ward::where('parent_code', $districtCode)->orderBy('name')->get();

        return response()->json(['data' => $wards]);
    }

    public function updateShipping(Request $request)
    {
        $provinceCode = $request->province_code;
        $dictrictCode = $request->district_code;

        $courier = Courier::where('province_code', $provinceCode)->where('district_code', $dictrictCode)->first();
        $discount = (float) session()->get('coupon')['discount'] ?? 0;
        $tax = $courier->amount ?? 20000;
        $subTotal = (float) str_replace(',', '', Cart::subtotal());
        $total = round($subTotal - $discount + $tax);

        return response()->json([
            'data' => [
                'tax' => number_format($tax, 0),
                'total' => number_format($total, 0),
            ],
        ]);
    }
}
