<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repositories\Order\OrderRepository;
use App\Repositories\OrderDetail\OrderDetailRepository;

class OrderController extends Controller
{
    /**
     * @var OrderRepositoryInterface|\App\Repositories\Repository
    */
    protected $orderRepository;

    /**
     * @var OrderDetailRepositoryInterface|\App\Repositories\Repository
    */
    protected $orderDetailRepository;

    public function __construct(
        OrderRepository $orderRepository, 
        OrderDetailRepository $orderDetailRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    /**
     * Display a listing of orders.
     *
     * @return View
     */
    public function index()
    {
        $orders = $this->orderRepository->getOrderWidthPagination();
        $orderDetails = [];
        foreach($orders as $order) {
            foreach($order->order_details as $value) {
                $orderDetails[] = [
                    'order_thumbnail' => $value->products->thumbnail,
                    'order_name' => $value->name,
                    'order_quantity' => $value->quantity,
                    'order_price' => $value->price,
                    'order_total_price' => $value->total_price
                ];
            }
        }
        
        return view('backend.order.index')
            ->with('orders', $orders)
            ->with('orderDetails', $orderDetails)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request orderId
     * @return \Illuminate\Http\Response
     */
    public function showOrderDetail(Request $request)
    {
        // get orderDetail by orderId
        $orderDetials = $this->orderDetailRepository->getOrderDetailByOrderId($request->id);
        // echo "<pre>";
        // var_dump($orderDetials);
        return response()->json([
            'status' => 200,
            'message' => 'Add success',
            'data' => [
                'orderDetail' => $orderDetials,
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return View
     */
    public function edit(Order $order)
    {
        return view('backend.order.edit')->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return JsonResponse
     */
    public function updatePartial(Request $request, Order $order)
    {
        $request->validate([
            'name' => 'required|string',
            'value' => 'required',
        ]);

        $result = $order->update([$request['name'] => $request['value']]);

        if ($result) {
            return response()->json(['success' => true, 'msg' => "Update {$request['name']} successfully!"], 200);
        }
        return response()->json(['success' => false], 400);
    }

    /**
     * Move the order to trash.
     *
     * @param Order $order
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Order $order)
    {
        $orders = Order::where('id',$order['id'])->first()->delete();
        return redirect()->back()->with('success', 'You have successfully move the product to trashed');
    }

    /**
     * Display a listing of the trashed products.
     *
     * @return View
     */
    public function trashed()
    {
        $orders = Order::onlyTrashed()->paginate(config('common.backend.pagination'));
        return view('backend.order.trashed')->with('orders', $orders);
    }

    /**
     * Restored a trashed product.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(Request $request, $id)
    {
        $orders = Order::onlyTrashed()->where('id', $id)->first();
        $orders->restore();
        return redirect()->back()->with('success', 'You have successfully restored the order');
    }

    /**
     * Force delete a trashed product.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function forceDelete($id)
    {
        $orders = Order::onlyTrashed()->where('id', $id)->first();
        foreach ($orders->order_details as $items) {
            $items->forceDelete();
        }
        $orders->forceDelete();
        return redirect()->back()->with('success', 'You have successfully deleted the product');
    }

    // update status shipping
    public function updateShipping(Request $request)
    {
        $result = $this->orderRepository->update($request->id, $request->all());
        if ($result) {
            return response()->json(['success' => true, 'msg' => "Update {$request['name']} successfully!"], 200);
        }
        return response()->json(['success' => false], 400);
        
    }
    
    // update status payment
    public function updatePayment(Request $request)
    {
        $result = $this->orderRepository->update($request->id, $request->all());
        if ($result) {
            return response()->json(['success' => true, 'msg' => "Update {$request['name']} successfully!"], 200);
        }
        return response()->json(['success' => false], 400);
    }
}
