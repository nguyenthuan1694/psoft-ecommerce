@extends('frontend.layouts.app') @section('content')
<link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<section class="mb-3">
    <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" navigation="true" space-between="30" centered-slides="true" autoplay-delay="3000" autoplay-disable-on-interaction="false">
        <swiper-slide><img class="swiper-slide" src="{{ asset('frontend/images/slider/aaa.jpg') }}" alt="Swiper" /></swiper-slide>
        <swiper-slide><img class="swiper-slide" src="{{ asset('frontend/images/slider/bbb.jpg') }}" alt="Swiper" /></swiper-slide>
    </swiper-container>
</section>
<section>
    <div class="container">
        <div class="row">
            @foreach($banners->take(2) as $item)
            <div class="col-md-6">
                <img style="border-radius: 5px;" src="{{ asset('../storage/app/'.$item->thumbnail) }}" alt="Img" class="img-responsive" />
            </div>
            @endforeach
        </div>
    </div>

    <div class="container section--default">
        <div class="row">
        @if(isset($searchResults))
        @if ($searchResults-> isEmpty())
            <h4 style="font-size: 18px; color: 000" class="mt-4 text-danger text-center">Sản phẩm "{{ $searchterm }}" bạn tìm kiếm hiện tại chưa cập nhật tại shop .</h4>
            <p class="text-center"><a href="{{ route('home') }}"> Xem thêm sản phẩm</a></p>
        @else
            <h4 style="font-size: 18px; color: 000" class="mt-4">Kết quả tìm kiếm: "{{ $searchterm }}" có {{ $searchResults->count() }} sản phẩm</h4>
                @foreach($searchResults as $product)
                <div class="abc col-lg-3 col-md-4 col-sm-6 col-xs-12 mt-4">
                    <div class="home--product">
                        <a href="{{ route('product', ['slug' => $product->searchable->slug]) }}">
                            <div class="home--product__img">
                                <img src="{{ asset('../storage/app/'.$product->searchable->thumbnail) }}" alt="Img" class="img-responsive" />
                                @if($product->searchable->cost)
                                <span class="btn btn-km"> {{ number_format((($product->searchable->price - $product->searchable->cost) / $product->searchable->cost) * 100) }}% </span>
                                @endif
                            </div>
                        </a>
                        <div class="home--product__text">
                            <div class="home--product__title">
                                <span><a class="home--product__name font-weight-bold" href="#">{{ $product->searchable->name }}</a></span>
                            </div>
                            <div class="home--product__description">
                                <p class="home--product__location">
                                    <strong>Giá:</strong>
                                    <span class="mr-2">{{ number_format($product->searchable->price) }}đ &nbsp;</span>
                                    @if($product->searchable->cost)
                                    <strong><del>{{ number_format($product->searchable->cost) }}đ</del></strong>
                                    @endif
                                </p>
                                <p>
                                    <strong>Khối lượng:</strong>
                                    <span class="mr-2">{{ $product->searchable->mass }}</span>
                                </p>
                                <p>
                                    <strong>Sản xuất tại:</strong>
                                    <span class="mr-2">{{ $product->searchable->made_in }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        @endif
        </div>
    </div>
</section>
@endsection @section('script')
<script src="{{ asset('backend/dist/js/validation-data.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
@endsection
