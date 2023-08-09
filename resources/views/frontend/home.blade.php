@extends('frontend.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <section class="mb-3">
        <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" navigation="true" space-between="30"
        centered-slides="true" autoplay-delay="3000" autoplay-disable-on-interaction="false">
            <swiper-slide>
                <img class="swiper-slide" src="{{ asset('frontend/images/slider/sld_3.png') }}" alt="Swiper"></swiper-slide>
            <swiper-slide>
                <img class="swiper-slide" src="{{ asset('frontend/images/slider/sld_1.jpeg') }}" alt="Swiper"></swiper-slide>
        </swiper-container>
    </section>
    <section>
    @if(isset($searchResults))
                @if ($searchResults-> isEmpty())
                    <h2>Sorry, no results found for the term <b>"{{ $searchterm }}"</b>.</h2>
                @else
                    <h2>There are {{ $searchResults->count() }} results for the term <b>"{{ $searchterm }}"</b></h2>
                    <hr />
                    @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                    <h2>{{ $type }}</h2>

                    @foreach($modelSearchResults as $searchResult)
                        <ul>
                            <!-- Biến $url được cấu hình trong file model-->
                            <a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a>
                        </ul>
                    @endforeach
                    @endforeach
                @endif
            @endif
        <div class="container">
            <div class="row">
                @foreach($banners->take(2) as $item)
                <div class="col-md-6 banner_adv">
                    <img style="border-radius: 5px" src="{{ asset('../storage/app/'.$item->thumbnail) }}" alt="Img" class="img-responsive">
                </div>
                @endforeach
            </div>
        </div>
        <!-- Sản phẩm nổi bật -->
        <div class="container mt-4">
            <div class="wrap_title mb__30 des_title_2">
                <h4 class="sections-title home-product_title">
                    <span>Sản phẩm nổi bật</span>
                </h4>
                <span class="dn tt_divider">
                    <span></span>
                    <i class="dn clprfalse title_2 la-gem"></i>
                    <span></span>
                </span>
                <div class="home-product_sub-title mt-3"><span class="section-subtitle db sub-title tc">Sản phẩm top trending</span></div>
            </div>
            <!-- product -->
            <div class="row">
                @foreach($products->take(8) as $product)
                    <div class="abc col-lg-3 col-md-4 col-sm-6 col-xs-12 mt-4">
                        <div class="home--product">
                            <a  href="{{ route('product', ['slug' => $product->slug]) }}">
                                <div class="home--product__img">
                                    <img src="{{ asset('../storage/app/'.$product->thumbnail) }}" alt="Img" class="img-responsive" />
                                    @if($product->cost)
                                        <span class="btn btn-km"> {{ number_format((($product->price - $product->cost) / $product->cost) * 100) }}% </span>
                                    @endif
                                </div>
                            </a>
                            <div class="home--product__text">
                                <div class="home--product__title">
                                    <span><a class="home--product__name font-weight-bold" href="#">{{ $product->name }}</a></span>
                                </div>
                                <div class="home--product__description">
                                    <p class="home--product__location">
                                        <strong>Giá:</strong>
                                        <span class="mr-2">{{ number_format($product->price) }}₫ &nbsp;</span>
                                        @if($product->cost)
                                            <strong><del>{{ number_format($product->cost) }}₫</del></strong>
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
        </div>
        <!-- end sản phẩm nổi bật -->
        <!-- Danh muc theo sản phẩm -->
        @foreach($categories as $category)
            @if(count($category->products) > 0)
                @if(empty($category->parent_id))
                <div class="container">
                    <div class="wrap_title mb__30 des_title_2">
                        <h3 class="sections-title home-product_title">
                            <span>{{ $category->name }}</span>
                        </h3>
                        <span class="dn tt_divider">
                            <span></span>
                            <i class="dn clprfalse title_2 la-gem"></i>
                            <span> </span>
                        </span>
                        <div class="home-product_sub-title mt-3"><span class="section-subtitle db sub-title tc">{{ $category->description }}</span></div>
                    </div>
                    <!-- product -->
                    <div class="row">
                        @foreach($category->products->take(12) as $product)
                            <div class="abc col-lg-3 col-md-4 col-sm-6 col-xs-12 mt-4">
                                <div class="home--product">
                                    <a  href="{{ route('product', ['slug' => $product->slug]) }}">
                                        <div class="home--product__img">
                                            <img src="{{ asset('../storage/app/'.$product->thumbnail) }}" alt="Img" class="img-responsive" />
                                            @if($product->cost)
                                                <span class="btn btn-km"> {{ number_format((($product->price - $product->cost) / $product->cost) * 100) }}% </span>
                                            @endif
                                        </div>
                                    </a>
                                    <div class="home--product__text">
                                        <div class="home--product__title">
                                            <span><a class="home--product__name font-weight-bold" href="#">{{ $product->name }}</a></span>
                                        </div>
                                        <div class="home--product__description">
                                            <p class="home--product__location">
                                                <strong>Giá:</strong>
                                                <span class="mr-2">{{ number_format($product->price) }}₫ &nbsp;</span>
                                                @if($product->cost)
                                                    <strong><del>{{ number_format($product->cost) }}₫</del></strong>
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
                    <div class="mt-0">
                        <div class="home--product__view">
                            <a href="{{ route('category', ['slug' => $category->slug]) }}" class="float-right mb-1">
                            » Xem tất cả
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            @endif
        @endforeach
        <!-- end danh mục theo sản phẩm -->
    </section>
@endsection

@section('script')
<script src="{{ asset('backend/dist/js/validation-data.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
@endsection