@extends('frontend.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('frontend/css/introduce.css') }}">
    {{ Breadcrumbs::render('news', $news) }}
    <section>
        <div class="container">
            <div class="container">
                <div class="row mt-3 introduce-news">
                    <div class="col-lg-9 col-sm-9 col-xs-12">
                        @foreach($news->take(10) as $items)
                            <div class="row">
                                <div class="col-md-5 news--introduce_img">
                                    <div class="introduce_img">
                                        <a href="{{ route('news', ['slug' => $items->slug]) }}"><img src="{{ asset('../storage/app/'.$items->thumbnail) }}" alt="" class="img-responsive"></a>
                                    </div>
                                    @if (strtotime(date("Y-m-d")) <= strtotime($items->updated_at))
                                    <div class="product-bage product-badge__outline">
                                        <div class="product-badge__inner">
                                            <span class="product-badge__stt">New</span><br>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-7 news-content">
                                    <div class="introduce-text">
                                        <a href="{{ route('news', ['slug' => $items->slug]) }}">
                                            <h5>{{ $items->title }}</h5>
                                            <p class="introduce-text__short_description">{{ $items->short_description }}</p>
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div class="col-lg-3 col-sm-3 col-xs-12">
                        <div class="list-cate-left">
                            <div class="introduce-product">
                                <h4 class="introduce-product__title">Sản phẩm nổi bật</h4>
                                <div class="introduce-product-content">
                                    @foreach($products->take(5) as $product)
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
                                                        <span class="mr-2">{{ number_format($product->price) }} đ</span>
                                                        @if($product->cost)
                                                            <strong><del>{{ number_format($product->cost) }}đ</del></strong>
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
            </div>
        </div>
    </section>
@endsection