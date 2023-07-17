<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer(
            [
                'frontend.layouts.app', 'frontend.category', 'frontend.search', 'frontend.checkout',
                'backend.product.create', 'backend.product.edit',
            ],
            'App\Http\View\Composers\Frontend\CategoryComposer'
        );

        View::composer(
            ['frontend.includes.cart_menu', 'frontend.cart', 'frontend.checkout'],
            'App\Http\View\Composers\Frontend\CartComposer'
        );

        $this->app->bind(
            \App\Repositories\Product\ProductRepositoryInterface::class,
            \App\Repositories\Product\ProductRepository::class
        );

        $this->app->bind(
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepository::class
        );

        $this->app->bind(
            \App\Repositories\Order\OrderRepositoryInterface::class,
            \App\Repositories\Order\OrderRepository::class
        );

        $this->app->bind(
            \App\Repositories\OrderDetail\OrderDetailRepositoryInterface::class,
            \App\Repositories\OrderDetail\OrderDetailRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
