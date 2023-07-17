@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('bill.index') }}">Hóa đơn</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lập hóa đơn</li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="container-fluid px-xxl-65 px-xl-20">
        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title text-uppercase">
                <span class="pg-title-icon"><span class="feather-icon"></span>
                </span>Phiếu lập hóa đơn
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
                            <form class="needs-validation" novalidate action="{{ route('bill.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="customer">Tên khách hàng</label>
                                        <input id="customer" name="customer" type="text" class="form-control" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="book_id">Tên sách</label>
                                        <select id="book_id" name="book_id" class="name_book form-control custom-select">
                                            <option>-----Select-----</option>
                                            @foreach($listBook as $key => $value)
                                                <option data-id="{{ $value->category }}"  value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">*Required</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="category">Thể loại</label>
                                        <input id="category"  readonly name="category" type="text" class="form-control" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="amount">Số lượng</label>
                                        <input id="amount" name="amount" type="number" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="unit_price">Đơn giá</label>
                                        <input id="unit_price" name="unit_price" type="number" class="form-control" value="">
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
            // Lấy thể loại sách
            $(".name_book").change(function() {
                categoryName = $(this).find(':selected').attr('data-id');
                $('#category').val(categoryName)
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

@endsection
