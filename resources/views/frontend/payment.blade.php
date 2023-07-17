@extends('frontend.layouts.app')

@section('content')
    {{ Breadcrumbs::render('cart') }}
    <link rel="stylesheet" href="{{ asset('frontend/css/cart.css') }}">
    <section>
        <div class="container cart__card">
            <div class="text-center">
                <span class="text-uppercase font-weight-bold" style="color: #ea2135">đặt hàng thành công</span>
            </div>
            <div style="padding: 15px 30px">
                <span style="font-size: 14px">Cảm ơn bạn đã mua hàng tại PSoft. BQT sẽ sớm liên hệ để xác nhận đơn hàng của bạn</span>
            </div>
            <div style="display: block;margin: 0 0px;line-height: 30px;font-size: 14px;color: #333;background: #f3f3f3;text-transform: uppercase;padding: 0 30px;">THÔNG TIN ĐẶT HÀNG:</div>
            <div class="infoorder">
                <div>Họ và  tên: Nguyen Van Thuan</div>
			     <div>Số điện thoại: 090.6633.63</div>
                <div>Tổng tiền: <strong><span class="price">{{ number_format($product->price, 0) }}&nbsp;₫</span></strong></div>
            </div>
            <div style="display: block;margin: 0 0px;line-height: 30px;font-size: 14px;color: #333;background: #f3f3f3;text-transform: uppercase;padding: 0 30px;">SẢN PHẨM ĐÃ MUA:</div>
            <div class="row">
                <div class="col-md-3">
                    <img style="display: block; width: 65px;height: 65px;margin: 5px auto 10px" src="{{ asset($product->thumbnail) }}" alt="">
                </div>
                <div class="col-md-6">
                    <div style="font-size: 13px">
                        {{ $product->name }}
                    </div>
                    <div style="font-size: 13px">
                        Số lượng: 1
                    </div>
                    <div style="font-size: 13px">
                        Màu: đỏ
                    </div>
                </div>
                <div class="col-md-3">
                    <span style="font-size: 13px; color: red">{{ number_format($product->price, 0) }}&nbsp;₫</span>
                </div>
            </div>
            <hr>
            <div class="buyother">
                <a class="btn-buyother" href="/">Mua thêm sản phẩm khác</a>
            </div>
            <div class="footer-hotline">
                Đặt mua qua điện thoại: 1800.6018 từ 8:00 - 21:00 giờ hàng ngày
            </div>
        </div>
    </section>
@endsection