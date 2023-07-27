<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\News;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->firstOfMonth();
        // News statistic
        $news = News::all();
        $newsTotal = $news->count();

        // Bannes statistic
        $banners = Banner::all();
        $bannerTotal = $banners->count();

        // Order statistic
        $orders = Order::all();
        $orderTotal = $orders->count();

        // Product statistic
        $products = Product::all();
        $productTotal = $products->count();
        // $productIncrease = $products->where('created_at', '>=', $date);
        // $productIncrease = $productTotal > 0 ? round($productIncrease->count() / $productTotal, 2) * 100 : 0;
        return view('backend.dashboard.index')
                ->with('newsTotal', $newsTotal)
                ->with('bannerTotal', $bannerTotal)
                ->with('orderTotal', $orderTotal)
                ->with('productTotal', $productTotal)
        ;
    }
}
