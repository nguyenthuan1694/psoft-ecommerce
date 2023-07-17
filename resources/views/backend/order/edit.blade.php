@extends('backend.layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Order</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->
    <div class="container-fluid px-xxl-65 px-xl-20">
        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Cập nhật đơn đặt hàng</h4>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <div class="row">
                        <div class="col-xl-5">
                            <section class="hk-sec-wrapper">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5 class="hk-sec-title">Thông tin khách hàng</h5>
                                        <div class="form-group">
                                            <div class="col-md">
                                                <label>Tên khách hàng:</label>
                                                {{ $order->fullname }}
                                            </div>
                                            <div class="col-md">
                                                <label>Địa chỉ:</label>
                                                {{ $order->address }}
                                            </div>
                                            <div class="col-md">
                                                <label>Số điện thoại:</label>
                                                {{ $order->phone }}
                                            </div>
                                            <div class="col-md">
                                                <label>Mail:</label>
                                                {{ $order->email }}
                                            </div>
                                            <div class="col-md">
                                                <label>Trạng thái:</label>
                                                {!! $order->status_text !!}
                                            </div>
                                            <div class="col-md">
                                                <label>Trạng thái thanh toán:</label>
                                                {!! $order->payment_status_text !!}
                                            </div>
                                            <div class="col-md">
                                                <label>Trạng thái giao hàng:</label>
                                                {!! $order->shipping_status_text !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-xl-7">
                            <section class="hk-sec-wrapper">
                                <h5 class="hk-sec-title">Thông tin đơn đặt hàng</h5>
                                @foreach($order->order_details as $orderItems)
                                    <div class="form-group">
                                        <div class="col-md">
                                            <label>Tên sản phẩm:</label>
                                            {{ $orderItems->name }}
                                        </div>
                                        <div class="col-md">
                                            <label>Số lượng:</label>
                                            {{ $orderItems->quantity }}
                                        </div>
                                        <div class="col-md">
                                            <label>Giá:</label>
                                            {{ number_format($orderItems->price, 0) }}&nbsp;đ
                                        </div>
                                        <div class="col-md">
                                            <label>Tổng tiền:</label>
                                            {{ number_format($orderItems->total_price, 0) }}&nbsp;đ
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </section>
                        </div>
                </section>
            </div>
        </div>
        <!-- /Row -->
    </div>
@endsection

@section('script')
    <!-- Select2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="{{ asset('backend/dist/js/select2-data.js') }}"></script>

    <!-- Bootstrap Input spinner JavaScript -->
    <script src="{{ asset('backend/vendors/bootstrap-input-spinner/src/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('backend/dist/js/inputspinner-data.js') }}"></script>

    <!-- Tinymce JavaScript -->
    <script src="{{ asset('backend/vendors/tinymce/tinymce.min.js') }}"></script>

    <!-- Tinymce Wysuhtml5 Init JavaScript -->
    <script src="{{ asset('backend/dist/js/tinymce-data.js') }}"></script>

    <!-- Dropify JavaScript -->
    <script src="{{ asset('backend/vendors/dropify/dist/js/dropify.min.js') }}"></script>

    <!-- Daterangepicker JavaScript -->
    <script src="{{ asset('backend/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Form Flie Upload Data JavaScript -->
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>

    <script src="{{ asset('backend/dist/js/validation-data.js') }}"></script>
    <script>
      $(function() {
        "use strict";
        $('input[name="date_available"]').daterangepicker({
          singleDatePicker: true,
          showDropdowns: true,
          minYear: 2000,
          "cancelClass": "btn-secondary",
          locale: {
            format: 'YYYY-MM-DD'
          }
        });

        $('input[name="date_of_delivery"]').daterangepicker({
          singleDatePicker: true,
          showDropdowns: true,
          minYear: 2000,
          "cancelClass": "btn-secondary",
          locale: {
            format: 'YYYY-MM-DD'
          }
        });
      });
    </script>
@endsection