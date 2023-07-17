@extends('frontend.layouts.app')

@section('content')
    {{ Breadcrumbs::render('cart') }}

    <link rel="stylesheet" href="{{ asset('frontend/css/cart.css') }}">
    <section>
        <div class="container cart__card">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ asset($product->thumbnail) }}" alt="">
                </div>
                <div class="col-md-9">
                    <span class="font-weight-bold">{{ $product->name }}</span>
                    <div class="mt-3">
                        <span style="font-weight: 600; color: #ea2135; font-size: 18px">{{ number_format($product->price, 0) }} đ</span>
                    </div>
                    <div class="mt-3 wrap-group-number">
                        <button class="btn-plus"><i class="ti-plus"></i></button>
                        <button class="btn-minus"><i class="ti-minus"></i></button>
                        <input type="text" disabled value="0">
                        <span class="remove-item" onclick="removeFromCart('{{ $product->id }}')"><small style="color: #ea2135">Xóa khỏi giỏ hàng</small></span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <span class="font-weight-bold" style="padding: 15px 30px">Tổng tiền</span>
                </div>
                <div class="col-md-8">
                    <span class="float-right mr-3" style="font-weight: 600; color: #ea2135; font-size: 18px">{{ number_format($product->price, 0) }} đ</span>
                </div>
            </div>
            <hr>
            <span style="padding: 15px 30px;" class="font-weight-bold">Thông tin mua hàng</span>
            <!-- < form action=""> -->
                <div style="padding: 15px 30px">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="name" style="font-size: 14px">Họ và tên</label>
                            <input style="font-size: 14px" type="text" placeholder="Vui lòng nhập họ tên" class="form-control">
                            <!-- <small class="form-text text-muted">*Required</small> -->
                        </div>
                        <div class="col-md-6">
                            <label for="phone" style="font-size: 14px">Số điện thoại</label>
                            <input style="font-size: 14px" type="text" placeholder="Vui lòng nhập số điện thoại" class="form-control">
                            <!-- <small class="form-text text-muted">*Required</small> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea placeholder="Ghi chú thêm nếu có..." name="description" class="tinymce" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="font-weight-bold">Chọn cách thức nhận hàng</span>
                    </div>
                    <div class="form-group mode-choose">
                        <div class="choose-label">
                            <a href="#" data-ship="at_shop" onclick="return setShipping(this);">Nhận hàng tại cửa hàng</a>
                            <a href="#" data-ship="at_home" onclick="return setShipping(this);">Giao hàng tận nơi</a>
                        </div>
                    </div>

                    <input type="hidden" name="shipping_method">
                    
                    <div class="form-group">
                        <div class="tab-shipping">
                            <div class="tab-pane" id="tab_at_shop">
                                <div class="tab-inner">
                                    <div class="tab-scroll">
                                        <ul class="scroll-store"><li><label><input type="radio" name="showroom" value="1"><span>198 Hoàng Văn Thụ, P. 04, Quận Tân Bình,&nbsp;TP.HCM (Ngay vòng xoay Lăng Cha Cả, Cuối đường Lê Văn Sỹ)</span></label></li><li><label><input type="radio" name="showroom" value="2"><span>621 Âu Cơ, Quận Tân Phú, HCM (Ngã 4 Âu Cơ &amp; Thoại Ngọc Hầu)</span></label></li><li><label><input type="radio" name="showroom" value="3"><span>367 Quang Trung, P. 10, Q. Gò Vấp, Tp HCM</span></label></li><li><label><input type="radio" name="showroom" value="5"><span>&nbsp;75 - 77 Trần Quang Khải, P. Tân Định, Quận 1, HCM</span></label></li><li><label><input type="radio" name="showroom" value="6"><span>177 Nguyễn Văn Linh, Q. Hải Châu, Đà Nẵng</span></label></li><li><label><input type="radio" name="showroom" value="7"><span>607-609 Lê Hồng Phong, P. 10, Quận 10, HCM</span></label></li><li><label><input type="radio" name="showroom" value="9"><span>232 Tân Hương, P. Tân Quý, Quận Tân Phú, Tp. Hồ Chí Minh</span></label></li><li><label><input type="radio" name="showroom" value="10"><span>97 Võ Văn Ngân, P. Linh Chiểu, Quận Thủ Đức, TP.HCM</span></label></li><li><label><input type="radio" name="showroom" value="11"><span>619&nbsp;Nguyễn Thị Thập, Phường Tân Hưng, Quận 7, TP.HCM (đối diện Lotte Mart)</span></label></li><li><label><input type="radio" name="showroom" value="12"><span>51 Lê Văn Việt, P. Hiệp Phú, Quận 9, TP.HCM</span></label></li><li><label><input type="radio" name="showroom" value="13"><span>626 Lê Quang Định, Phường 1, Quận Gò Vấp (Ngay ngã 4 Phạm Văn Đồng và Lê Quang Định)</span></label></li><li><label><input type="radio" name="showroom" value="14"><span>745A Đường 3/2, Phường 6, Quận 10, TP.HCM (Ngay ngã 3 Nguyễn Kim &amp; 3/2)</span></label></li><li><label><input type="radio" name="showroom" value="15"><span>217 Bà Hom, Phường 13, Quận 6, TP.HCM</span></label></li><li><label><input type="radio" name="showroom" value="27"><span>87C Nguyễn Ảnh Thủ, Khu phố 3, Phường Trung Mỹ Tây, Quận 12, TP.HCM (Ngay sát trung tâm văn hoá Quận 12)</span></label></li><li><label><input type="radio" name="showroom" value="28"><span>316 Tùng Thiện Vương, Phường 13, Quận 8</span></label></li><li><label><input type="radio" name="showroom" value="29"><span>315 Đỗ Xuân Hợp, Phường Phước Long B, Quận 9, TP.HCM</span></label></li></ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_at_home">
                                <div class="tab-inner">
                                    <div class="tab-scroll">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="name" style="font-size: 14px">Tỉnh/Thành phố</label>
                                                <input style="font-size: 14px" id="name" name="name" type="text" placeholder="Vui lòng nhập họ tên" class="form-control" value="">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" style="font-size: 14px">Quận/Huyện</label>
                                                <input style="font-size: 14px" id="phone" name="phone" type="text" placeholder="Vui lòng nhập số điện thoại" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <textarea placeholder="Địa chỉ..." name="description" class="tinymce" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <form action="{{ route('cart.index') }}" method="get" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button style="border: 0" class="col-info" type="submit">Đặt hàng trước, thanh toán sau
                                <span>(Thanh toán tại nhà hoặc tại cửa hàng)</span>
                            </button>
                            <!-- <div class="orpayment">
                                <span>Hoặc thanh toán Online</span>
                            </div> -->
                        </div>
                    </form>
                    <!-- <div class="form-group">
                        <div class="list-payment-online">
                            <div class="item-payment">
                                <lable data-method="payoo">
                                    <input type="radio" name="payment_method" value="payoo"><i class="icon-payment icon-payment-payoo"></i> 
                                    Thanh toán thông qua Payoo	
                                </lable>
                            </div>
                        </div>
                    </div> -->
                </div>
            <!-- </ form> -->
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        $('.btn-plus').click(function () {
            if ($('#qty').val() < 4 ) {
                $('#qty').val(parseInt($('#qty').val()) + 1);
            }
        });
        $('.btn-minus').click(function () {
            if ($('#qty').val() > 0) {
                $('#qty').val(parseInt($('#qty').val()) - 1);
            }
        });
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