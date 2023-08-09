@extends('frontend.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('frontend/css/introduce.css') }}">
{{ Breadcrumbs::render('introduce', $news) }}
<section>
    <div class="container">
        <div class="introduce-product row">
            <div class="col-lg-9 col-sm-6 col-sx-12">
                <h5 class="text-uppercase">{{ $news->title }}</h5>
                <div class="mt-3">
                    {{ $news->short_description }}
                </div>
                <div class="mt-3">
                    <img src="{{ asset($news->thumbnail) }}" alt="">
                </div>
                <div class="mt-3">
                {!! $news->long_description !!}
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-sx-12">
                <div class="introduce-product">
                    <h4 class="introduce-product__title">Tin Tức</h4>
                    <div class="introduce-product-content">
                        @foreach($newsData->take(10) as $news)
                        <ul>
                            <li class="introduce-product__li">
                                <div class="row">
                                    <div class="col-md-5 cool-sm-5 introduce-product__img">
                                        <div class="product-img__same">
                                            <a href="{{ route('news', ['slug' => $news->slug]) }}"><img src="{{ asset('../storage/app/'.$news->thumbnail) }}" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="introduce-product__content col-md-7 col-sm-7">
                                        <a href="{{ route('news', ['slug' => $news->slug]) }}" class="introduce-product__text font-weight-bold">
                                            {{ $news->title }}
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @endforeach
                    </div>
                </div>
                <div class="introduce-product">
                    <h4 class="introduce-product__title">Sản phẩm nổi bật</h4>
                    <div class="introduce-product-content">
                        @foreach($products->take(15) as $product)
                            <ul>
                                <li class="introduce-product__li">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-5 introduce-product__img">
                                            <div class="product-img__same">
                                                <a href="{{ route('product', ['slug' => $product->slug]) }}"><img src="{{ asset('../storage/app/'.$product->thumbnail) }}" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="introduce-product__content col-md-8 col-sm-7">
                                            <a href="{{ route('product', ['slug' => $product->slug]) }}" class="introduce-product__text font-weight-bold">
                                                {{ $product->name }}
                                            </a>
                                            <p>
                                                <strong>Giá:</strong>
                                                <span class="mr-2">{{ number_format($product->price) }}₫</span>
                                                @if($product->cost)
                                                    <strong><del>{{ number_format($product->cost) }}₫</del></strong>
                                                @endif
                                            </p>
                                            <p>
                                                <strong>Khối lượng:</strong>
                                                <span class="mr-2">{{ $product->mass }}</span>
                                            </p>
                                            <p>
                                                <strong>Sản xuất:</strong>
                                                <span class="mr-2">{{ $product->made_in }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection