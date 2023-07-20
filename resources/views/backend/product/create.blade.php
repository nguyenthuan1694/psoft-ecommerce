@extends('backend.layouts.app') 
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="RangeValidation" class="form-horizontal" enctype="multipart/form-data" novalidate action="{{ route('products.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header card-header-rose card-header-text">
                            <div class="card-text">
                                <h4 class="card-title">Thêm sản phẩm</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="name" class="col-form-label">Tên sản phẩm *</label>
                                    <div class="form-group">
                                        <input id="name" type="text" class="form-control" name="name" value="" required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="slug" class="col-form-label">Slug *</label>
                                    <div class="form-group">
                                        <input id="slug" type="text" class="form-control" name="slug" value="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="sku" class="col-form-label">Sku *</label>
                                    <div class="form-group">
                                        <input id="sku" type="text" class="form-control" name="sku" value="" required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="mass" class="col-form-label">Khối lượng *</label>
                                    <div class="form-group">
                                        <input id="mass" type="text" class="form-control" name="mass" value="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="made_in" class="col-form-label">Sản xuất tại *</label>
                                    <div class="form-group">
                                        <input id="made_in" type="text" class="form-control" name="made_in" value="" required />
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="status" class="col-form-label">Trạng thái</label>
                                    <div class="form-group">
                                        <select id="status" name="status" class="selectpicker" data-style="select-with-transition">
                                            @foreach($allStatus as $key => $value)
                                            <option value="{{ $value }}">{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="price" class="col-form-label">Giá</label>
                                    <div class="form-group">
                                        <input id="price" type="number" min="100" step="100" class="form-control" name="price" value="" />
                                        <div class="input-custom-append">
                                            <span class="input-custom-text">VNĐ</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="cost" class="col-form-label">Chi phí</label>
                                    <div class="form-group">
                                        <input id="cost" type="number" min="100" step="10" class="form-control" name="cost" value="" />
                                        <div class="input-custom-append">
                                            <span class="input-custom-text">VNĐ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="stock" class="col-form-label">Stock</label>
                                    <div class="form-group">
                                        <input id="stock" type="number" class="form-control" name="stock" min="0" step="1" value="100" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="date_available" class="col-form-label">Ngày tạo</label>
                                    <div class="form-group">
                                        <input id="date_available" type="text" class="form-control" name="date_available" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="categories" class="col-form-label">Danh mục</label>
                                    <div class="form-group">
                                        <select id="categories" name="categories[]" class="selectpicker" data-style="select-with-transition" multiple title="--- ROOT ---">
                                            @include('backend.includes.categories_options', ['categories' => $categories, 'dash' => '', 'selected' =>[], 'type' => 'multiple'])
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="product_type" class="col-form-label">Loại sản phẩm</label>
                                    <div class="form-group">
                                        <select id="product_type" name="product_type" class="selectpicker" data-style="select-with-transition" title="--- ROOT ---">
                                            @foreach($typeProduct as $key => $value)
                                            <option value="{{ $value }}">{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-7">
                                    <label class="col-form-label">Short Description</label>
                                    <div class="form-group tinymce-wrap">
                                        <textarea class="form-control tinymce" rows="3" name="short_description"> </textarea>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md">
                                            <label>Thumbnail</label>
                                            <input name="thumbnail" type="file" class="dropify" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Long Description</label>
                                    <div class="form-group tinymce-wrap">
                                        <textarea class="form-control tinymce" rows="3" name="long_description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Images</label>
                                    <div class="dropzone" id="remove_link">
                                        <div class="fallback">
                                            <input type="file" multiple name="images" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-info">CREATE</button>
                            <a href="{{ route('products.index') }}" class="btn btn-light">CANCEL</a>
                        </div>
                        <input type="file" name="images[]" multiple class="d-none" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection @section('css')

<!-- Bootstrap Dropzone CSS -->
<link href="{{ asset('backend/vendors/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css" />

<!-- Bootstrap Dropify CSS -->
<link href="{{ asset('backend/vendors/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endsection @section('script')
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

<!-- Dropzone JavaScript -->
<script src="{{ asset('backend/vendors/dropzone/dist/dropzone.js') }}"></script>

<!-- Dropify JavaScript -->
<script src="{{ asset('backend/vendors/dropify/dist/js/dropify.min.js') }}"></script>

<!-- Daterangepicker JavaScript -->
<script src="{{ asset('backend/vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('backend/vendors/daterangepicker/daterangepicker.js') }}"></script>

<!-- Form Flie Upload Data JavaScript -->
<script>
    $(document).ready(function () {
        $(".dropify").dropify();
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
                $(".dz-progress").hide();
                if (this.files.length) {
                    var _i, _len;
                    for (
                        _i = 0, _len = this.files.length;
                        _i < _len - 1;
                        _i++ // -1 to exclude current file
                    ) {
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
            });
        },
    });

    function setFormValidation(id) {
        $(id).validate({
            highlight: function (element) {
                $(element).closest(".form-group").removeClass("has-success").addClass("has-danger");
                $(element).closest(".form-check").removeClass("has-success").addClass("has-danger");
            },
            success: function (element) {
                $(element).closest(".form-group").removeClass("has-danger").addClass("has-success");
                $(element).closest(".form-check").removeClass("has-danger").addClass("has-success");
            },
            errorPlacement: function (error, element) {
                $(element).closest(".form-group").append(error);
            },
        });
    }

    $(document).ready(function () {
        setFormValidation("#RegisterValidation");
        setFormValidation("#TypeValidation");
        setFormValidation("#LoginValidation");
        setFormValidation("#RangeValidation");
    });
</script>

<script src="{{ asset('backend/dist/js/slugify.js') }}"></script>
<script>
    let inputName = document.getElementById("name");
    inputName.onchange = function () {
        document.getElementById("slug").value = slugify(document.getElementById("name").value);
    };
</script>

<script src="{{ asset('backend/dist/js/validation-data.js') }}"></script>
<script>
    $(function () {
        "use strict";
        $('input[name="date_available"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 2000,
            cancelClass: "btn-secondary",
            locale: {
                format: "YYYY-MM-DD",
            },
        });
    });
</script>
@endsection
