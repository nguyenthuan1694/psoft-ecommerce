<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\News;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\News\NewsRepository;
use Spatie\Searchable\Search;
use Spatie\Searchable\ModelSearchAspect;

class HomeController extends Controller
{
    /**
     * @var CategoryRepositoryInterface|\App\Repositories\Repository
    */

    protected $categoryRepository;

    /**
     * @var ProductRepositoryInterface|\App\Repositories\Repository
    */
    protected $productRepository;

    

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::with(['products'])->root()->get();
        $products = Product::where('product_type', 1)->orderBy('updated_at','DESC')->get();
        $banners = Banner::where('status', 1)->get();
        return view('frontend.home')
                ->with('categories', $categories)
                ->with('banners', $banners)
                ->with('products', $products)
        ;
    }

    /**
     * Show the category page
     *
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCategory(Request $request, $slug)
    {
        $resultData = $this->categoryRepository->getCategoryBySlug($slug);
        $category = $resultData[0];
        $products = $resultData[1];
        $banners = Banner::where('status', 1)->get();
        $categories = Category::with(['products'])->root()->get();
        $news = News::paginate(config('common.pagination.backend'));
        return view('frontend.category')
            ->with('category', $category)
            ->with('products', $products)
            ->with('categories', $categories)
            ->with('news', $news)
            ->with('banners', $banners)
        ;
    }

    /**
     * Show the product page
     *
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProduct(Request $request, $slug)
    {
        $product = $this->productRepository->getProductBySlug($slug);
        $products = $this->productRepository->getProductOtherSlug($slug);
        $categories = Category::with(['products'])->root()->get();
        $banners = Banner::where('status', 1)->get();
        return view('frontend.product')
            ->with('product', $product)
            ->with('products', $products)
            ->with('categories', $categories)
            ->with('banners', $banners)
        ;
    }


    public function showNewsIndex()
    {
        $news = News::orderBy('updated_at','DESC')->paginate(config('common.pagination.backend'));
        $products = Product::paginate(config('common.pagination.backend'));
        return view('frontend.news_of_event.index')
                ->with('products', $products)
                ->with('news', $news);
    }

    /**
     * Show news
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNews(Request $request, $slug) 
    {
        $news = News::where('slug', '=', $slug)->first();
        $newsData = News::where('slug', '<>', $slug)->orderBy('created_at','DESC')->get();
        $products = Product::paginate(config('common.pagination.backend'));
        return view('frontend.news_of_event.news')
                ->with('news', $news)
                ->with('newsData', $newsData)
                ->with('products', $products);
    }

    public function showIntroduce()
    {
        return view('frontend.introduce');
    }

    public function showContact()
    {
        return view('frontend.contact');
    }

    public function search(Request $request)
    {
        $searchterm = $request->input('query');

        $searchResults = (new Search())
            ->registerModel(Product::class, ['name', 'sku']) //apply search on field name and description
            //Config partial match or exactly match
            // ->registerModel(Category::class, function (ModelSearchAspect $modelSearchAspect) {
            //     $modelSearchAspect
            //         ->addExactSearchableAttribute('name') // only return results that exactly match
            //         ->addSearchableAttribute('description'); // return results for partial matches
            // })
            ->perform($searchterm);
        $banners = Banner::where('status', 1)->get();
        return view('frontend.search', compact('searchResults', 'searchterm', 'banners'));
    }
}
