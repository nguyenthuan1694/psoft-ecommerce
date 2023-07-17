@extends('backend.layouts.app') 
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="RangeValidation" class="form-horizontal" novalidate action="{{ route('categories.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header card-header-rose card-header-text">
                            <div class="card-text">
                                <h4 class="card-title">Thêm danh mục</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Tên danh mục</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input id="name" type="text" class="form-control" name="name" value="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Slug</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input id="slug" type="text" class="form-control" name="slug" value="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Parent</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="selectpicker" data-style="select-with-transition" multiple title="--- ROOT ---">
                                            @include('backend.includes.categories_options', ['categories' => $allCategory, 'dash' => '', 'selected' => 'NULL', 'type' => 'single'])
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" name="description" placeholder="Write some description about the category"> </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-info">CREATE</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-light">CANCEL</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection @section('script')
<script src="{{ asset('backend/dist/js/slugify.js') }}"></script>
<script>
    let inputName = document.getElementById("name");
    inputName.onchange = function () {
        document.getElementById("slug").value = slugify(document.getElementById("name").value);
    };

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
@endsection
