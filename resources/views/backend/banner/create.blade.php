@extends('backend.layouts.app') @section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="RangeValidation" class="form-horizontal" enctype="multipart/form-data" novalidate action="{{ route('banners.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header card-header-rose card-header-text">
                            <div class="card-text">
                                <h4 class="card-title">Thêm banner</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input id="title" type="text" class="form-control" name="title" value="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Slug</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input id="slug" type="text" class="form-control" name="slug" value="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Trang thái</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <select id="status" name="status" class="selectpicker" data-style="select-with-transition">
                                            @foreach($allStatus as $key => $value)
                                            <option value="{{ $value }}">{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Thumbnail</label>
                                <div class="col-sm-10">
                                    <input type="file" name="thumbnail" class="dropify" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-info">CREATE</button>
                            <a href="{{ route('banners.index') }}" class="btn btn-light">CANCEL</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection @section('css')
<!-- select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

<!-- Daterangepicker CSS -->
<link href="{{ asset('backend/vendors/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />

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
<!-- Form Flie Upload Data JavaScript -->
<script src="{{ asset('backend/dist/js/slugify.js') }}"></script>
<script>
    let inputName = document.getElementById("title");
    inputName.onchange = function () {
        document.getElementById("slug").value = slugify(document.getElementById("title").value);
    };
</script>
<script src="{{ asset('backend/dist/js/validation-data.js') }}"></script>

@endsection
