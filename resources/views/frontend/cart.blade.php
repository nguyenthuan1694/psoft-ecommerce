@extends('frontend.layouts.app')

@section('content')
    {{ Breadcrumbs::render('cart') }}
    <section>
        <div class="container vrsg-cart">
            <div class="row">
                <div class="col-lg-8 col-sm-7 col-12 cart-left section--default">
                    <div class="section-title product-cart_title">
                        <h5>Bạn có {{ $cart::count() }} sản phẩm </h5>
                    </div>
                    <div class="wrap-list-item">
                        @foreach($cart::content() as $product)
                        <div class="cart-item">
                            <div class="wrap-img-cart">
                                <a href="#"><img src="{{ $product->options['img'] }}" alt=""></a>
                                <span class="cart-qty">{{ $product->qty }}</span>
                            </div>
                            <div class="cart-info_content">
                                <h4><span href="#">{{ $product->name }}</span></h4>
                                <div>SKU: <span>{{ $product->options['sku'] }}</span></div>
                                <div><span>{{ number_format($product->price, 0) }} VNĐ</span></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 col-sm-5 col-12 cart-right">
                    <div class="wrap-layout-r">
                        <div class="cart-info">
                            <h4 class="wiget-title-cart">
                                Thông tin đơn hàng
                            </h4>
                            <div class="wrap-apply-promo">
                                <div class="">
                                    <div class="shipping-text" >Phí vận chuyển sẽ được tính ở trang thanh toán.</div>
                                    <div class="shipping-text" >Mã giảm giá chưa được áp dụng cho sản phẩm này.</div>
                                    <hr>
                                    <p class="mt-2">Tổng tiền:<span style="float: right"><strong>{{ $newSubtotal }} VNĐ</strong></span></p>
                                    <p class="p-promo">Mã giảm giá:<span style="float: right">0 VNĐ</span></p>
                                    <p>Tạm tính:<span style="float: right" class="price">{{ $newSubtotal }} VNĐ</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="text-center go-checkout">
                            <a href="{{ route('cart.getCheckout') }}" class="btn-default float-right w-100">Thanh toán ngay</a>
                        </div>
                        <div class="pre-home mt-2">
                            <a href="{{ route('home') }}"><i class="fas fa-hand-point-left"></i>&nbsp;Tiếp tục mua hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        function setShipping(obj)
	    {
            $this=$(obj);
            $this.closest("div").find(".active").removeClass("active");
            $this.addClass("active");
            $("input[name='shipping_method']").val(jQuery(obj).data("ship"));
            $(".tab-shipping .tab-pane").hide();
            $("#tab_"+$(obj).data("ship")).fadeIn();
            return false;
	    }
    </script>
@endsection
