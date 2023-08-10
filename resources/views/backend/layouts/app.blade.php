<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{ asset('backend/img/icon_title.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        PSoft
    </title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport" />
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="PSoft" />
    <!-- Material Icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Toastr CSS -->
    <link href="{{ asset('backend/vendors/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('backend/css/material-dashboard.min.css' )}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('backend/demo/demo.css' )}}" rel="stylesheet" />
    
    @yield('css')
</head>
<body class="">
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <div class="load-wrapp" id="pageLoader">
        <div class="load-3">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </div>
    <div class="wrapper">
        @include('backend.layouts.vertical_nav')
        <div class="main-panel">
            @include('backend.layouts.top_nav')
            
            @yield('content')

            @include('backend.layouts.footer')
        </div>
    </div>
    <!-- @include('backend.layouts.setting_panel') -->

<!-- jQuery -->
<!--   Core JS Files   -->
<script src="{{ asset('backend/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('backend/js/core/popper.min.js') }}"></script>
<script src="{{ asset('backend/js/core/bootstrap-material-design.min.js') }}"></script>
<!-- <script src="{{ asset('backend/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script> -->
<!-- Plugin for the momentJs  -->
<script src="{{ asset('backend/js/plugins/moment.min.js') }}"></script>
<!--  Plugin for Sweet Alert -->
<script src="{{ asset('backend/js/plugins/sweetalert2.js') }}"></script>
<!-- Forms Validations Plugin -->
<script src="{{ asset('backend/js/plugins/jquery.validate.min.js') }}"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{ asset('backend/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('backend/js/plugins/bootstrap-selectpicker.js') }}"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{ asset('backend/js/plugins/bootstrap-datetimepicker.min.js') }}"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{ asset('backend/js/plugins/bootstrap-tagsinput.js') }}"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset('backend/js/plugins/jasny-bootstrap.min.js') }}"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{ asset('backend/js/plugins/fullcalendar.min.js') }}"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{ asset('backend/js/plugins/jquery-jvectormap.js') }}"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('backend/js/plugins/nouislider.min.js') }}"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="{{ asset('backend/js/plugins/arrive.min.js') }}"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('backend/js/plugins/bootstrap-notify.js') }}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<!-- <script src="{{ asset('backend/js/material-dashboard.min.js') }}" type="text/javascript"></script> -->
<!-- chartjs -->
<script src="{{ asset('backend/js/plugins/chartist.min.js') }}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('backend/demo/demo.js') }}"></script>

<!-- Toastr JS -->
<script src="{{ asset('backend/vendors/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
  
@include('backend.includes.notifications')

@yield('script')
<script>
    $(window).on('beforeunload', function(){
        $('#pageLoader').show();
    });

    $(function () {
        $('#pageLoader').hide();
    })
</script>
    
</body>
</html>
