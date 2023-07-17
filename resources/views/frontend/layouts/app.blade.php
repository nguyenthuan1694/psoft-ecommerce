<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <link rel="icon" type="image/png" href="{{ asset('frontend/images/logos/icon_title.png') }}" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name', 'Psoft') }}</title>

        <!-- Fonts -->
        <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

        <!-- Styles -->
        <!-- <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}"> -->
        <link rel="stylesheet" href="{{ asset('frontend/themify-icons/themify-icons.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/css/vrsg.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/css/footer.css') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />

        <link href="{{ asset('frontend/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('frontend/css/nucleo-svg.css') }}" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('frontend/css/material-dashboard.css' )}}" rel="stylesheet" />
        <!-- Nepcha Analytics (nepcha.com) -->
        @yield('css')
    </head>

    <body>
        @include('frontend.layouts.header')
        <div class="load-wrapp" id="pageLoader">
            <div class="load-3">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>
        @yield('content') @include('frontend.layouts.footer')
        <div class="backtotop"><i class="ti-angle-double-up"></i></div>
        <div class="socail-zalo"><a target="blank" href="https://zalo.me/0908855483">Chat Zalo</a></div>
        <div class="socail-hotline"><a target="blank" href="tel:0908855483">Hotline: 090.8855.483</a></div>
        <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
        <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('frontend/js/slick.js') }}"></script>
        <script src="{{ asset('frontend/js/vrsg.js') }}"></script>
        <!-- Toastr JS -->
        <script src="{{ asset('backend/vendors/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
        @include('frontend.includes.notifications') @yield('script')

        <script>
            $(window).on('beforeunload', function(){
                $('#pageLoader').show();
            });

            $(function () {
                $('#pageLoader').hide();
            })
            //   document.onreadystatechange = function () {
            //     if (document.readyState !== "complete") {
            //         document.querySelector(
            //             "body").style.visibility = "hidden";
            //         document.querySelector(
            //             "#loader").style.visibility = "visible";
            //     } else {
            //         document.querySelector(
            //             "#loader").style.display = "none";
            //         document.querySelector(
            //             "body").style.visibility = "visible";
            //     }
            // };
                function removeFromCart(row_id) {
                  $.ajax({
                    type: 'DELETE',
                    url: '{{ route('cart.remove') }}',
                    data: {
                      _token: '{{ csrf_token() }}',
                      row_id: row_id,
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


                $(document).ready(function() {
  $("#sidebarCollapseCustom").on("click", function() {
      console.log('ssss')
    $("#sidebarCustom").addClass("active");
  });

  $("#sidebarCollapseX").on("click", function() {
    $("#sidebarCustom").removeClass("active");
  });

  $("#sidebarCollapseCustom").on("click", function() {
    if ($("#sidebarCustom").hasClass("active")) {
      $(".overlay-custom").addClass("visible");
      console.log("it's working!");
    }
  });

  $("#sidebarCollapseX").on("click", function() {
    $(".overlay-custom").removeClass("visible");
  });
});
        </script>
    </body>
</html>
