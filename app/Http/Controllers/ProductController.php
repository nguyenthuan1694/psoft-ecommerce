<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductImageStore;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Category;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Category\CategoryRepository;

class ProductController extends Controller
{
    /**
     * @var CommentRepositoryInterface|\App\Repositories\Repository
    */
    protected $productRepository;

    /**
     * @var CategoryRepositoryInterface|\App\Repositories\Repository
    */
    protected $categoryRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of products.
     *
     * @return View
     */
    public function index()
    {
        // $products = $this->productRepository->getProductWidthPagination();
        $products = $this->productRepository->getAll();
        return view('backend.product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return View
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAll();
        $allStatus = config('common.product.status');
        $typeProduct = config('common.product.type');
        return view('backend.product.create')
            ->with('categories', $categories)
            ->with('allStatus', $allStatus)
            ->with('typeProduct', $typeProduct)
        ;
    }

    /**
     * Store a new product.
     *
     * @param ProductStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ProductStoreRequest $request)
    {
        $product = $this->productRepository->create($request->except(['categories','thumbnail', 'images']));
        // Sync Categories
        $categories = $request->get('categories') ?? [];
        $product->categories()->sync($categories);
        $productImg = 'product';
        // Add thumbnail
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnailName = generateProductImageName($product->date_available, $file->getClientOriginalExtension());
            $thumbnailPath = generateProductImagePath($product->date_available);
            $file->storeAs($thumbnailPath, $thumbnailName);
            // $product->thumbnail = Storage::url($thumbnailPath . '/' .$thumbnailName);
            $product->thumbnail = $thumbnailPath . '/' .$thumbnailName;
            $product->save();
        }
        // Add images
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $imageName = generateProductImageName($product->date_available, $file->getClientOriginalExtension(), 'image');
                $imagePath = generateProductImagePath($product->date_available, 'image');
                $file->storeAs($imagePath, $imageName);
                [$width, $height] = getimagesize($file);
                $image = new Image([
                    // 'url' => Storage::url($imagePath . '/' .$imageName),
                    'url' => $imagePath . '/' .$imageName,
                    'width' => $width,
                    'height' => $height,
                    'size' => $file->getSize()
                ]);
                $product->images()->save($image);
            }
        }

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công !');
    }

    /**
     * Display the product.
     *
     * @param Product $product
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the product.
     *
     * @param Product $product
     * @return View
     */
    public function edit(Product $product)
    {
        $categories = $this->categoryRepository->getAll();
        $allStatus = config('common.product.status');
        $typeProduct = config('common.product.type');
        return view('backend.product.edit')
            ->with('product', $product)
            ->with('allStatus', $allStatus)
            ->with('categories', $categories)
            ->with('typeProduct', $typeProduct)
        ;
    }

    /**
     * Update the product.
     *
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $this->productRepository->update($request->id, $request->except(['categories','thumbnail']));
        // Sync Categories
        $categories = $request->get('categories') ?? [];
        $product->categories()->sync($categories);

        // update thumbnail
        if ($request->hasFile('thumbnail')) {
            if (file_exists(public_path() . $product->thumbnail)) {
                unlink(public_path() . $product->thumbnail);
            }
            $file = $request->thumbnail;
            $thumbnailName = generateProductImageName($product->sku,$file->getClientOriginalExtension());
            $thumbnailPath = generateProductImagePath($product->sku);
            $file->storeAs($thumbnailPath, $thumbnailName);
            // $product->thumbnail = Storage::url($thumbnailPath . '/' .$thumbnailName);
            $product->thumbnail = $thumbnailPath . '/' .$thumbnailName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Câp nhật sản phẩm thành công !');
    }

    /**
     * Move the product to trash.
     *
     * @param Product $product
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        $products = Product::where('id',$product['id'])->first()->delete();

        return redirect()->back()->with('success', 'Chuyển thành công sản phẩm vào thùng rác !');
    }

    /**
     * Display a listing of the trashed products.
     *
     * @return View
     */
    public function trashed()
    {
        $products = Product::onlyTrashed()->paginate(config('common.backend.pagination'));
        return view('backend.product.trashed')->with('products', $products);
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
        $product = Product::onlyTrashed()->where('id', $id)->first();
        $product->restore();
        return redirect()->back()->with('success', 'Khôi phuc thành công sản phẩm !');
    }

    /**
     * Force delete a trashed product.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->where('id', $id)->first();
        foreach ($product->images as $image) {
            if (file_exists(public_path() . $image->url)) {
                unlink(public_path() . $image->url);
            }
            $image->delete();
        }
        $product->forceDelete();
        return redirect()->back()->with('success', 'Xóa sản phẩm thành công !');
    }

    /**
     * Display a listing of product images.
     *
     * @param Product $product
     * @return View
     */
    public function editImages(Product $product)
    {
        return view('backend.product.edit_images')->with('product', $product->load('images'));
    }

    /**
     * Store product images.
     *
     * @param Product $product
     * @param ProductImageStore $request
     * @return RedirectResponse
     */
    public function addImages(Product $product, ProductImageStore $request)
    {
        $files = $request->images;
        foreach ($files as $file) {
            $imageName = generateProductImageName($file->getClientOriginalExtension(), 'image');
            $imagePath = generateProductImagePath('image');
            $file->storeAs($imagePath, $imageName);
            [$width, $height] = getimagesize($file);
            $image = new Image([
                'product_id' => $product->id,
                'url' => $imagePath . '/' .$imageName,
                'width' => $width,
                'height' => $height,
                'size' => $file->getSize()
            ]);
            $product->images()->save($image);
        }

        return redirect()->back()->with('success', 'Upload hình sản phẩm thành công !');
    }

    /**
     * Delete a product image.
     *
     * @param Product $product
     * @param Image $image
     * @return RedirectResponse
     * @throws Exception
     */
    public function deleteImage(Product $product, Image $image)
    {
        foreach ($product->images as $item) {
            if ($item->id == $image->id) {
                if (file_exists(public_path() . $image->url)) {
                    unlink(public_path() . $image->url);
                }
                $image->delete();
            }
        }

        return redirect()->back()->with('success', 'Xóa thành công hình ảnh sản phẩm !');
    }
}
