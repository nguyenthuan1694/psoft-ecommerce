@extends('frontend.layouts.app')

@section('content')
    {{ Breadcrumbs::render('category', $category) }}
    <link rel="stylesheet" href="{{ asset('frontend/css/category.css') }}">
    <section>
        <div class="container vrsg-categories">
            <div class="row">
                <div class="col-md-3 category--list__left">
                    <div class="category--list">
                        <h4 class="category--list__title">
                            Danh mục
                        </h4>
                        <ul class="category--list__content text-uppercase">
                            @include('frontend.includes.categories_left_menu', ['categories' => $categories])
                        </ul>
                    </div>
                    <div class="category--list__news mt-4">
                        <h4 class="category--list__title">Tin tức</h4>
                        <div class="category--list_news_content">
                        @foreach($news->take(10) as $items)
                            <ul>
                                <li class="category-news__li">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 category-news__img">
                                            <div class="">
                                                <a href="{{ route('news', ['slug' => $items->slug]) }}"><img src="{{ asset('../storage/app/'.$items->thumbnail) }}" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-7 category-news__contents">
                                            <a href="{{ route('news', ['slug' => $items->slug]) }}" class="category-news__content font-weight-bold">
                                               {{ $items->title }}
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-9 category--list__right">
                    <!-- banner QC -->
                    <div class="row">
                        @foreach($banners->take(2) as $item)
                        <div class="col-md-6 banner_adv ">
                            <img style="border-radius: 5px" src="{{ asset('../storage/app/'.$item->thumbnail) }}" alt="Img" class="img-responsive"></div>
                        @endforeach
                    </div>
                    <!-- end banner QC -->
                    <div class="category_section-title mt-3">
                        <h2 class="category--list__right-title">{{ $category->name }}</h2>
                    </div>
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-md-3 col-sm-4 mt-4">
                            <div class="category-cp-product" data-animate-in="up">
                                <a  href="{{ route('product', ['slug' => $product->slug]) }}">
                                    <div class="product--same__img">
                                        <img src="{{ asset('../storage/app/'.$product->thumbnail) }}" alt="Img" class="img-responsive" />
                                        @if($product->cost)
                                            <span class="btn btn-category-discount"> {{ number_format((($product->price - $product->cost) / $product->cost) * 100) }}% </span>
                                        @endif
                                    </div>
                                </a>
                                <div class="product--same__text">
                                    <div class="title-product">
                                        <span><a class="product-grid__title" href="{{ route('product', ['slug' => $product->slug]) }}">{{ $product->name }}</a></span>
                                    </div>
                                    <div class="product--same__description">
                                        <p class="product-grid__location">
                                            <strong>Giá:</strong>
                                            <span class="mr-2">{{ number_format($product->price) }}đ &nbsp;</span>
                                            @if($product->cost)
                                                <strong><del>{{ number_format($product->cost) }}đ</del></strong>
                                            @endif
                                        </p>
                                        <p>
                                            <strong>Khối lượng:</strong>
                                            <span class="mr-2">{{ $product->mass }}</span>
                                        </p>
                                        <p>
                                            <strong>Sản xuất tại:</strong>
                                            <span class="mr-2">{{ $product->made_in }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{ $products->links('frontend.includes.pagination') }}
                </div>
            </div>
        </div>
    </section>
@endsection