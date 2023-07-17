@extends('backend.layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="RangeValidation" class="form-horizontal" enctype="multipart/form-data" novalidate action="{{ route('products.update', ['product' => $product->id]) }}" method="post">
                    @method('PUT')
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header card-header-rose card-header-text">
                            <div class="card-text">
                                <h4 class="card-title">Cập nhật sản phẩm</h4>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="name" class="col-form-label">Tên sản phẩm *</label>
                                    <div class="form-group">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}" required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="slug" class="col-form-label">Slug *</label>
                                    <div class="form-group">
                                        <input id="slug" type="text" class="form-control" name="slug" value="{{ $product->slug }}" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="sku" class="col-form-label">Sku *</label>
                                    <div class="form-group">
                                        <input id="sku" type="text" class="form-control" name="sku" value="{{ $product->sku }}" required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="mass" class="col-form-label">Khối lượng *</label>
                                    <div class="form-group">
                                        <input id="mass" type="text" class="form-control" name="mass" value="{{ $product->mass }}" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="made_in" class="col-form-label">Sản xuất tại *</label>
                                    <div class="form-group">
                                        <input id="made_in" type="text" class="form-control" name="made_in" value="{{ $product->made_in }}" required />
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="status" class="col-form-label">Trạng thái</label>
                                    <div class="form-group">
                                        <select id="status" name="status" class="selectpicker" data-style="select-with-transition" title="--- ROOT ---">
                                            @foreach($allStatus as $key => $value)
                                            <option value="{{ $value }}" @if($value == $product->status) selected @endif>{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="price" class="col-form-label">Giá</label>
                                    <div class="form-group">
                                        <input id="price" type="number" min="100" step="100" class="form-control" name="price" value="{{ $product->price }}" />
                                        <div class="input-custom-append">
                                            <span class="input-custom-text">VNĐ</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="cost" class="col-form-label">Chi phí</label>
                                    <div class="form-group">
                                        <input id="cost" type="number" min="100" step="10" class="form-control" name="cost" value="{{ $product->cost }}" />
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
                                        <input id="stock" type="number" class="form-control" name="stock" min="0" step="1" value="{{ $product->stock }}" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="date_available" class="col-form-label">Ngày tạo</label>
                                    <div class="form-group">
                                        <input id="date_available" type="text" class="form-control" name="date_available" value="{{ $product->date_available }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="categories" class="col-form-label">Danh mục</label>
                                    <div class="form-group">
                                        <select id="categories" name="categories[]" class="selectpicker" data-style="select-with-transition" multiple title="--- ROOT ---">
                                            @include('backend.includes.categories_options', ['categories' => $categories, 'dash' => '', 'selected' => $product->categories()->pluck('id')->toArray(), 'type' => 'multiple'])
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="product_type" class="col-form-label">Loại sản phẩm</label>
                                    <div class="form-group">
                                        <select id="product_type" name="product_type" class="selectpicker" data-style="select-with-transition" title="--- ROOT ---">
                                            @foreach($typeProduct as $key => $value)
                                            <option value="{{ $value }}" @if($value == $product->product_type) selected @endif>{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-7">
                                    <label class="col-form-label">Short Description</label>
                                    <div class="form-group tinymce-wrap">
                                        <textarea class="form-control tinymce" rows="3" name="short_description"> {{ $product->short_description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md">
                                            <label>Thumbnail</label>
                                            <input name="thumbnail" type="file" class="dropify" data-default-file="{{ asset('../storage/app/'.$product->thumbnail) }}" data-max-file-size="1M"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Long Description</label>
                                    <div class="form-group tinymce-wrap">
                                        <textarea class="form-control tinymce" rows="3" name="long_description">{{ $product->long_description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-info">UPDATE</button>
                            <a href="{{ route('products.index') }}" class="btn btn-light">CANCEL</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <!-- select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- Daterangepicker CSS -->
    <link href="{{ asset('backend/vendors/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Dropify CSS -->
    <link href="{{ asset('backend/vendors/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>
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
