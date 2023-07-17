@extends('frontend.layouts.app')

@section('content')
    {{ Breadcrumbs::render('cart') }}
    <link rel="stylesheet" href="{{ asset('frontend/css/cart.css') }}">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <section>
        <div class="container" style="max-width: 800px">
            <div class="mb-2">
                <a href="/" style="text-decoration: none; color: #0056b3;"><i class="fa fa-reply"></i>&nbsp;{!! trans('cart.buy-more') !!}</a>
            </div>
        </div>
        <div class="container cart__card">
            <div class="mb-2">
                <span style="padding: 10px" class="font-weight-bold">{!! trans('cart.info') !!}</span>
            </div>
            @if(Cart::count() > 0)
            <table class="table" id="order-entry">
                @foreach(Cart::content() as $product)
                <tr>
                    <td><img class="img-fluid img-thumbnail" style="width: 100px; height: auto"  src="{{ asset($product->options->img) }}" alt="img"></td>
                    <td>
                        <span class="font-weight-bold" style="color: #ea2135; font-size: 14px;">{{ number_format($product->price, 0) }}&nbsp;đ</span>
                        <input type="hidden" class="form-calc form-cost" value="{{ $product->price }}">
                        <input type="hidden" class="productId" value="{{ $product->id }}">
                    </td>
                    <td>
                        <input type="hidden" class="qty" value="{{ $product->qty }}">
                        <input type="text" min="0" max="5" class="form-calc form-qty item-count form-control" value="{{ $product->qty }}">
                    </td>
                    <td>
                        <button class="delete-item btn btn-danger" onclick="removeFromCart('{{$product->rowId}}')" data-name="{{ $product->name }}">X</button>
                    </td>
                    <td>
                        <input class="form-line form-control" value="{{ number_format(($product->qty) * $product->price) }}" readonly>
                        <input type="hidden" class="price form-control" value="{{ $product->qty * $product->price }}" readonly>
                    </td>
                </tr>
                
                @endforeach
                <tr>
                    <td colspan="1" class="font-weight-bold">{!! trans('cart.total-price') !!}</td>
                    <td id="total" style="color: #ea2135; font-weight: 600; font-size: 14px"></td>
                </tr>
            </table>
            <hr>
            <span style="padding: 10px;" class="font-weight-bold">{!! trans('cart.info-customer') !!}</span>
            <form name="checkout" action="{{ route('cart.postCheckout') }}" method="post">
                @csrf
                <div style="padding: 15px 30px">
                    <!-- @if ($errors->any())
                        @foreach ($errors->all() as $error)
                           <p style="color: #dc3545">{{ $error }}</p>
                        @endforeach
                    @endif -->
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="fullname" style="font-size: 14px">{!! trans('cart.full-name') !!}</label>
                            <input style="font-size: 14px" id="fullname" name="fullname" type="text" placeholder="{!! trans('cart.place-fullName') !!}" class="form-control @error('fullname') is-invalid @enderror">
                            @error('fullname')<small style="color: #dc3545">{!! trans('cart.req-fullName') !!}</small>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" style="font-size: 14px">{!! trans('cart.email') !!}</label>
                            <input style="font-size: 14px" id="email" name="email" type="text" placeholder="{!! trans('cart.place-email') !!}" class="form-control  @error('email') is-invalid @enderror">
                            @error('email')<small style="color: #dc3545">{!! trans('cart.req-email') !!}</small>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <div class="col-md-6">
                            <label for="phone" style="font-size: 14px">{!! trans('cart.phone') !!}</label>
                            <input style="font-size: 14px" id="phone" name="phone" type="text" placeholder="{!! trans('cart.place-phone') !!}" class="form-control  @error('phone') is-invalid @enderror">
                            @error('phone')<small style="color: #dc3545">{!! trans('cart.req-phone') !!}</small>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="house_number" style="font-size: 14px">{!! trans('cart.number-house') !!}</label>
                            <input style="font-size: 14px" type="text" name="house_number" placeholder="{!! trans('cart.place-numberHouse') !!}" class="form-control @error('house_number') is-invalid @enderror">
                            @error('house_number')<small style="color: #dc3545">{!! trans('cart.req-numberHouse') !!}</small>@enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <select id="province" name="province_code" class="province col-md-4 form-control custom-select @error('province_code') is-invalid @enderror">
                            <option value="" selected>{!! trans('cart.province') !!}</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->code }}">{{ $province->name_with_type }}</option>
                            @endforeach
                        </select>
                        @error('province_code')<small style="color: #dc3545">{!! trans('cart.req-province') !!}</small>@enderror
                    </div>
                    <div class="form-group">
                        <select id="district" name="district_code" class="col-md-4 form-control custom-select @error('district_code') is-invalid @enderror">
                            <option value="" selected>{!! trans('cart.district') !!}</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->code }}">{{ $district->name_with_type }}</option>
                            @endforeach
                        </select>
                        @error('district_code')<small style="color: #dc3545">{!! trans('cart.req-district') !!}</small>@enderror
                    </div>
                    <div class="form-group">
                        <select id="ward" name="ward_code" class="col-md-4 form-control custom-select @error('ward_code') is-invalid @enderror">
                            <option value="" selected>{!! trans('cart.ward') !!}</option>
                            @foreach($wards as $ward)
                                <option value="{{ $ward->code }}">{{ $ward->name_with_type }}</option>
                            @endforeach
                        </select>
                        @error('ward_code')<small style="color: #dc3545">{!! trans('cart.req-ward') !!}</small>@enderror
                    </div>
                    <hr>
                    <!-- <form action="{{ route('cart.getCheckout') }}" method="get" enctype="multipart/form-data"> -->
                        <div class="form-group">
                            <button name="btnCheckout" style="border: 0" class="col-info" type="submit">{!! trans('cart.text-1') !!}
                                <span>{!! trans('cart.text-2') !!}</span>
                            </button>
                            <!-- <div class="orpayment">
                                <span>Hoặc thanh toán Online</span>
                            </div> -->
                        </div>
                    <!-- </form> -->
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
            </form>
            @endif
            @if(Cart::count() == 0)
            <hr>
            <div style="padding: 10px 30px">
                <div class="text-center">{!! trans('cart.text-3') !!}</div>
                <div class="text-center">
                    <a href="/" style="color: #0056b3; text-decoration: none">{!! trans('cart.home') !!}</a>
                </div>
                <div class="text-center">
                <small>{!! trans('cart.text-4') !!}</small>
                </div>
            </div>
            @endif
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        $('.remove-item').click(function() {
		    $(this).parents('.item-view-cart').remove();
        });

        $("#order-entry").on("change", ".form-calc", function() {
            
            var parent = $(this).closest("tr");
            
            var qty = parent.find(".qty").val();
            var qtyc = parent.find(".form-qty").val();

            if(qty > qtyc) {
                var sl = (qtyc - qty)
            } else {
                var sl = qtyc - qty;
            }
            var productId = parent.find(".productId").val();
            addToCart(productId, sl);
            var price = new Intl.NumberFormat('en').format(parent.find(".form-qty").val() * parent.find(".form-cost").val());
            var priceHidden = parent.find(".form-qty").val() * parent.find(".form-cost").val();
            parent.find(".price").val(priceHidden);
            parent.find(".form-line").val(price);
            var totalPrice = 0;
            var total = 0;
            $(".price").each(function(){
                totalPrice += parseFloat($(this).val()||0);
            });
            $(".form-line").each(function() {
                total += parseFloat($(this).val()||0);
            });
            $("#total").text(new Intl.NumberFormat('en').format(totalPrice)+ ' đ');
           
        });

        // add order
        function addToCart(id, qty) {
            $.ajax({
                type: 'POST',
                url: '{{ route('cart.add') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: id,
                    qty: qty
                }
            }).then(function (res) {
                // $('#cart_qty').html(res.data.count);
                $('#cart_content').html(function () {
                    let html = '';
                    // res.data.content.forEach(function (e) {
                    //    html = html +
                    //        `<div class="item-view-cart">
                    //             <div class="w-item-mini">
                    //                 <img src="${e.options.img}" alt="">
                    //             </div>
                    //             <div class="content-text-item">
                    //                 <a href="#">${e.name}</a>
                    //                 <p>${e.qty} x ${e.price} VNĐ</p>
                    //             </div>
                    //             <span class="remove-item" onclick="removeFromCart('${e.rowId}')"><i class="ti-close"></i></span>
                    //         </div>`;
                    // });
                    // return html;
                })
                // $('#cart_total').html(res.data.total);
            });
        }

        // loại bỏ items trùng lập trong mảng
        function getUnique(array) {
            var uniqueArray = [];
            // Loop through array values
            for(i=0; i < array.length; i++){
                if(uniqueArray.indexOf(array[i]) === -1) {
                    uniqueArray.push(array[i]);
                }
            }
            return uniqueArray;
        }

        //
        function loadTable() {
            var price = [];
            $('.form-calc').each(function(){
                var parent = $(this).closest("tr");
                var total = parent.find(".form-qty").val() * parent.find(".form-cost").val();
                price.push(total)
            });
            var priceTotal = getUnique(price);
            return new Intl.NumberFormat('en').format(priceTotal.reduce((a, b) => a + b, 0))+ ' đ';
        }
        $("#total").text(loadTable());

        // change cách thức nhận hàng
        function setShipping(obj)
	    {
            $this=$(obj);
            $this.closest("div").find(".active").removeClass("active");
            $this.addClass("active");
            $("input[name='shipping_method']").val($(obj).data("ship"));
            $(".tab-shipping .tab-pane").hide();
            $("#tab_"+$(obj).data("ship")).fadeIn();
            return false;
	    }
        
        // remove cart items
        function removeFromCart(row_id) {
          $.ajax({
            type: 'DELETE',
            url: '{{ route('cart.remove') }}',
            data: {
              _token: '{{ csrf_token() }}',
              row_id: row_id,
            }
          }).then(function (res) {
            var totalItems = res.data.count;
            if(totalItems < 1) {
                window.location = document.location.origin
            } else {
                location.reload();
            }
            
            // $('#cart_qty').html(res.data.count);
            
            // $('#order-entry').html(function () {
            //   let html = '';
            //     res.data.content.forEach(function (e) {
            //     html = html +
            //         `<tr>
            //             <td><img class="img-fluid img-thumbnail" style="width: 100px; height: auto"  src="${e.options.img}" alt="img"></td>
            //             <td>
            //                 <span class="font-weight-bold" style="color: #ea2135; font-size: 14px;">${e.price}&nbsp;đ</span>
            //                 <input type="hidden" class="form-calc form-cost" value="${e.price}">
            //             </td>
            //             <td>
            //                 <input type="number" class="form-calc form-qty item-count form-control" value="${e.qty}">
            //             </td>
            //             <td>
            //                 <button class="delete-item btn btn-danger" onclick="removeFromCart('${e.rowId}')" data-name="${e.name}">X</button>
            //             </td>
            //             <td>
            //                 <input class="form-line form-control" value="${(e.qty*(e.price))}" readonly>
            //                 <input type="hidden" class="price form-control" value="${e.qty} * ${e.price}" readonly>
            //             </td>
            //         </tr>`
            //         ;
            //   });
            //   html += `<tr>
            //             <td colspan="1" class="font-weight-bold">Tổng Tiền: </td>
            //             <td id="total" style="color: #ea2135; font-weight: 600; font-size: 14px"></td>
            //         </tr>`;

                   
            //   return html;
             
            // })
          });
        }

        $('#province').change(function () {
            let selected =  $(this).children("option:selected").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('cart.getListDistrict') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    provinceCode: selected,
                }
            }).then(function (res) {
                let html = '';
                res.data.forEach(function (e) {
                    html += `<option value="${e.code}">${e.name_with_type}</option>`;
                });
                $('#district').html(html);
                $('#district').trigger('change');
            })
        });

        $('#district').change(function () {
            let selected =  $(this).children("option:selected").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('cart.getListWard') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    districtCode: selected,
                }
            }).then(function (res) {
                let html = '';
                res.data.forEach(function (e) {
                    html += `<option value="${e.code}">${e.name_with_type}</option>`;
                });
                $('#ward').html(html);
                $('#ward').trigger('change');
            })
        });
        $('#ward').change(function () {
            getAddressString();
            let province_code = $('#province').children("option:selected").val();
            let district_code = $('#district').children("option:selected").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('cart.updateShipping') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    province_code: province_code,
                    district_code: district_code
                }
            }).then(function (res) {
                let tax = `${res.data.tax} VNĐ`;
                let total = `${res.data.total} VNĐ`;
                $('p.tax > span').text(tax);
                $('p.total > span').text(total);
            });
        });

        $("#province").select2({});
        $("#district").select2({});
        $("#ward").select2({});
        
        $('button[name="btnCheckout"]').click(function () {
            $('form[name="checkout"]').submit();
        });
    </script>
@endsection
