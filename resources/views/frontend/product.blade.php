@extends('frontend.layouts.app')

@section('content')
    {{ Breadcrumbs::render('product', $product) }}
    <link rel="stylesheet" href="{{ asset('frontend/css/product.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <section>
        <div class="container">
            <div class="bg-qc row mb-3">
                @foreach($banners->take(2) as $item)
                <div class="col-md-6 banner_adv ">
                    <img style="border-radius: 5px" src="{{ asset('../storage/app/'.$item->thumbnail) }}" alt="Img" class="img-responsive">
                </div>
                @endforeach
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-5 col-sm-5 col-xs-12">
                    <div class="wrap-image-pro">
                        @foreach($product->images as $images)
                            <img src="{{ asset('../storage/app/'.$images->url) }}" alt="">
                        @endforeach
                    </div>
                    <div class="thumnail">
                        @foreach($product->images as $images)
                            <img src="{{ asset('../storage/app/'.$images->url) }}" alt="">
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-7 col-sm-7 col-xs-12">
                    <div class="product--wrap_title">
                        <span class="font-weight-bold" style="font-size: 24px">{{ $product->name }}</span>
                        <span class="product attribute font-italic sku" style="font-size: 13px;color: #808080">( SKU: {{ $product->sku }})</span>
                    </div>
                    
                    <div class="product--date__content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                        </svg>
                        <span class="product--date__text">{{ date('d/m/Y', strtotime($product->created_at)) }}</span>
                    </div>
                    <div class="wrap-price-detail">
                        <span class="price mr-2">{{ number_format($product->price, 0) }} đ&nbsp;</span>
                        @if($product->cost)
                            <strong><del class="mr-2">{{ number_format($product->cost, 0) }} đ</del></strong>
                            <span class="btn discount">{{ number_format((($product->price - $product->cost) / $product->cost) * 100) }}%</span>
                        @endif
                    </div>
                    <div>
                        <div style="margin-bottom: 20px; margin-top: 15px;font-size: 14px;background: whitesmoke;padding: 20px;border-radius: 10px;">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    {!! $product->short_description !!}
                                </div>
                            </div>
                        </div>
                        <div class="box-tocart">
                            <div class="fieldset">
                                <div class="actions">
                                    <p>Tình trạng: Còn hàng</p>
                                    <button class="btn-default-solid" onclick="addToCart({{$product->id}}, {{$product->qty}})">Mua hàng</button>
                                    <div class="wrap-group-number">
                                        <button class="btn-plus"><i class="ti-plus"></i></button>
                                        <button class="btn-minus"><i class="ti-minus"></i></button>
                                        <input id="qty" type="text" disabled="" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="container long_description">
        <hr>
            <div class="">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#info" role="tab" data-toggle="tab"
                        class="nav-link active"> Thông tin sản phẩm </a>
                    </li>
                    <li class="nav-item">
                        <a href="#ratings" role="tab" data-toggle="tab"
                        class="nav-link"> Chính sách vận chuyển </a>
                    </li>
                    <li class="nav-item">
                        <a href="#plus" role="tab" data-toggle="tab"
                        class="nav-link"> Chính sách đổi trả</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="info">
                        <p class="mt-3">{!! $product->long_description !!}</p>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="ratings">
                        <p class="mt-3"> {!! config('common.shipping_policy.content') !!} </p>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="plus">
                        <p class="mt-3">{!! config('common.return_policy.content') !!} </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4">
           <div class="product--same__card">
                <h5 class="text-uppercase">Sản phẩm tương tự</h5>
                <hr>
                <div class="row">
                    @foreach($products->take(4) as $product)
                        <div class="col-md-3 col-sm-4">
                            <div class="wsk-cp-product" data-animate-in="up">
                                <a  href="{{ route('product', ['slug' => $product->slug]) }}">
                                    <div class="product--same__img">
                                        <img src="{{ asset('../storage/app/'.$product->thumbnail) }}" alt="Img" class="img-responsive" />
                                        @if($product->cost)
                                            <span class="btn btn-discount"> {{ number_format((($product->price - $product->cost) / $product->cost) * 100) }}% </span>
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
                                            <span class="mr-2">{{ number_format($product->price) }}đ</span>
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
           </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('backend/dist/js/validation-data.js') }}"></script>
    <script type="text/javascript">

        $('.btn-plus').click(function () {
            if ($('#qty').val() < {{ $product->stock }}) {
                $('#qty').val(parseInt($('#qty').val()) + 1);
            }
        });

        $('.btn-minus').click(function () {
            if ($('#qty').val() > 0) {
                $('#qty').val(parseInt($('#qty').val()) - 1);
            }
        });

        var clickCount = 0;
        function showImage(obj)
        {
            if(!clickCount){clickCount++;return ;}
             var imageObj =  (list_images);
             var iThumb=[];
             let img;
            objId=jQuery(obj).data('id');
           
            for(xin in imageObj['images'][objId])
            {
                iThumb.push(imageObj['images'][objId][xin]['img']);
            } 

            if(iThumb.length)
            {
                for(x in iThumb)
                {
                    

                   jQuery(".nav-gallery-right img").attr("src",iThumb.pop());
                    break;
                }
            }
        }
        // 
        function addCommentBox(id, phone) {
            // Check if comment box is already exist
            var targetDiv = document.getElementById('i-comment-' + id).getElementsByClassName("comment-temp")[0];

            if(targetDiv != undefined) {
            return;
            }

            // Check if comment is already exist at other comments
            targetDiv = document.getElementsByClassName('comment-temp')[0];
            if(targetDiv != undefined) {
            targetDiv.remove();
            }

            // HTML comment box 
            var newNotificationHtml = `
                <div class="input-group w-auto flex-nowrap ml-4 ml-md-5 mt-4 comment-temp">
                    <div class="input-group-prepend mr-2">
                    <img src="{{ asset('frontend/images/avatars/default.png') }}" class="img-fluid avatar-img mr-2" alt="Responsive image">
                    </div>
                    <div class="w-100">
                        <div class="form-group tinymce-wrap mt-3">
                            <textarea id="i-comment-temp" placeholder="Hãy đặt câu hỏi, chúng tôi sẽ tư vấn giúp bạn..." name="description_sub" class="tinymce" rows="3"></textarea>
                        </div>
                    </div>           
                </div>
                <div class="text-right mt-2 mb-4">
                        <a href="javascript:;" class="text09 btn btn-discount bg-color-white color-pink" onclick="saveComment(`+id+`,`+phone+`)" >Gửi phản hồi</a>
                </div>
                `;

            // Add
            $('#i-comment-' + id).append(newNotificationHtml);
            document.getElementById('i-comment-temp').focus();
        }

    // add order
    function addToCart(id, qty) {
            $.ajax({
                type: 'POST',
                url: '{{ route('cart.add') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: id,
                    qty: $('#qty').val()
                }
            }).then(function (res) {
                $('#cart_qty').html(res.data.count);
                $('#cart_content').html(function () {
                    let html = '';
                    res.data.content.forEach(function (e) {
                       html = html +
                           `<div class="item-view-cart">
                                <div class="w-item-mini">
                                    <img src="${e.options.img}" alt="">
                                </div>
                                <div class="content-text-item">
                                    <a href="#">${e.name}</a>
                                    <p>${e.qty} x ${e.price} VNĐ</p>
                                </div>
                                <span class="remove-item" onclick="removeFromCart('${e.rowId}')"><i class="ti-close"></i></span>
                            </div>`;
                    });
                    return html;
                })
                $('#cart_total').html(res.data.total);
            });
        }
    </script>
    <script src="{{ asset('frontend/js/product.js') }}"></script>
@endsection
