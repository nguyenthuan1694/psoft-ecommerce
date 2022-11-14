@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('receipt.index') }}">Phiếu thu</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lập phiếu thu</li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="container-fluid px-xxl-65 px-xl-20">
        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title text-uppercase">
                <span class="pg-title-icon"><span class="feather-icon"></span>
                </span>Phiếu lập phiếu thu
            </h4>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="hk-sec-title text-uppercase">Thông tin</h5>
                    <div class="row">
                        <div class="col-sm">
                            <form class="needs-validation" novalidate action="{{ route('receipt.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="bill_id">Tên khách hàng</label>
                                        <select id="bill_id" name="bill_id" class="form-control custom-select">
                                            <option>-----Select-----</option>
                                            @foreach($listBill as $key => $value)
                                                <option data-value="{{ $value->id }}" data="{{ $value->books{0}['id'] }}" data-id="{{ $value->bills{0}['customer'] }}" value="{{ $value->bills{0}['id'] }}">
                                                    {{ $value->bills{0}['customer'].'-'.$value->books{0}['name'].' - Số lượng : '.$value->amount.' - Giá :'.$value->unit_price }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input id="full_name" name="full_name" type="hidden" class="form-control" value="">
                                        <input id="book_id" name="book_id" type="hidden" class="form-control" value="">
                                        <input id="id_bill_detail" name="id_bill_detail" type="hidden" class="form-control" value="">
                                        <small class="form-text text-muted">*Required</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="address">Địa chỉ</label>
                                        <input id="address" name="address" type="text" class="form-control" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone">Số điện thoại</label>
                                        <input id="phone" name="phone" type="text" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input id="email" name="email" type="text" class="form-control" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fall_day">Ngày thu tiền</label>
                                        <input id="fall_day" name="fall_day" type="text" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="proceeds">Số tiền thu</label>
                                        <input id="proceeds" name="proceeds" type="number" class="form-control" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="amount_owed">Số tiền nợ</label>
                                        <input id="amount_owed" name="amount_owed" type="number" class="form-control" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button class="btn btn-info" type="submit">CREATE</button>
                                        <a href="{{ route('bill.index') }}" class="btn btn-light">CANCEL</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

            </div>
        </div>
        <!-- /Row -->
    </div>
@endsection

@section('css')
    <!-- select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- Daterangepicker CSS -->
    <link href="{{ asset('vendors/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Dropzone CSS -->
    <link href="{{ asset('vendors/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Bootstrap Dropify CSS -->
    <link href="{{ asset('vendors/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('script')
    <!-- Select2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="{{ asset('dist/js/select2-data.js') }}"></script>

    <!-- Bootstrap Input spinner JavaScript -->
    <script src="{{ asset('vendors/bootstrap-input-spinner/src/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('dist/js/inputspinner-data.js') }}"></script>

    <!-- Tinymce JavaScript -->
    <script src="{{ asset('vendors/tinymce/tinymce.min.js') }}"></script>

    <!-- Tinymce Wysuhtml5 Init JavaScript -->
    <script src="{{ asset('dist/js/tinymce-data.js') }}"></script>

    <!-- Dropzone JavaScript -->
    <script src="{{ asset('vendors/dropzone/dist/dropzone.js') }}"></script>

    <!-- Dropify JavaScript -->
    <script src="{{ asset('vendors/dropify/dist/js/dropify.min.js') }}"></script>

    <!-- Daterangepicker JavaScript -->
    <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/daterangepicker/daterangepicker.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
            // Lấy tên khách hàng
            $("#bill_id").change(function() {
                customer = $(this).find(':selected').attr('data-id');
                $('#full_name').val(customer)
                book = $(this).find(':selected').attr('data');
                $('#book_id').val(book)
                bill_id = $(this).find(':selected').attr('data-value');
                $('#id_bill_detail').val(bill_id)
            });
        });
        

        Dropzone.autoDiscover = false;
        $("div#remove_link").dropzone({
            url: "#",
            autoProcessQueue: false,
            addRemoveLinks: true,
            dictDuplicateFile: "Duplicate Files Cannot Be Uploaded",
            preventDuplicates: true,
            init: function () {
                this.on("addedfile", function (file) {
                    $('.dz-progress').hide();
                    if (this.files.length) {
                        var _i, _len;
                        for (_i = 0, _len = this.files.length; _i < _len - 1; _i++) // -1 to exclude current file
                        {
                            if (this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModified.toString() === file.lastModified.toString()) {
                                this.removeFile(file);
                            }
                        }
                    }
                    setTimeout(() => {
                        var fileList = new DataTransfer();
                        this.files.forEach((file) => {
                            fileList.items.add(file);
                        });
                        document.querySelectorAll('input[name="images[]"]')[0].files = fileList.files;
                    }, 0);
                });
                this.on("removedfile", function (file) {
                    var fileList = new DataTransfer();
                    this.files.forEach((file) => {
                        fileList.items.add(file);
                    });
                    document.querySelectorAll('input[name="images[]"]')[0].files = fileList.files;
                })
            },
        });
    </script>
    <!-- Form Flie Upload Data JavaScript -->
    <script src="{{ asset('dist/js/slugify.js') }}"></script>
     <script>
        let inputName = document.getElementById('title');
        inputName.onchange = function(){
            document.getElementById('slug').value = slugify(document.getElementById('title').value);
        }
        
    </script>
    <script src="{{ asset('dist/js/validation-data.js') }}"></script>
    <script>
        $(function() {
            "use strict";
            $('input[name="fall_day"]').daterangepicker({
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
