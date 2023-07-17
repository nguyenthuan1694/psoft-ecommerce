@extends('backend.layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="RangeValidation" class="form-horizontal" novalidate action="{{ route('news.update', ['news' => $news->id]) }}" enctype="multipart/form-data" method="post">
                    @method('PUT') 
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $news->id }}">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-text">
                            <div class="card-text">
                                <h4 class="card-title">Cập nhật tin tức</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input id="title" type="text" class="form-control" name="title" value="{{ $news->title }}" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Slug</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input id="slug" type="text" class="form-control" name="slug" value="{{ $news->slug }}" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <div class="tinymce-wrap">
                                        <textarea class="form-control" rows="5" name="short_description" >
                                        {{ $news->short_description }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Thumbnail</label>
                                <div class="col-sm-10">
                                    <input type="file" name="thumbnail" class="dropify" data-default-file="{{ asset('../storage/app/'.$news->thumbnail) }}" data-max-file-size="1M" />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Long Description</label>
                                <div class="col-sm-10">
                                    <div class="tinymce-wrap">
                                        <textarea class="tinymce" rows="3" name="long_description" >
                                        {{ $news->long_description }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-info">UPDATE</button>
                            <a href="{{ route('news.index') }}" class="btn btn-light">CANCEL</a>
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

    <!-- Bootstrap Dropzone CSS -->
    <link href="{{ asset('backend/vendors/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css"/>

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

    <!-- Dropzone JavaScript -->
    <script src="{{ asset('backend/vendors/dropzone/dist/dropzone.js') }}"></script>

    <!-- Dropify JavaScript -->
    <script src="{{ asset('backend/vendors/dropify/dist/js/dropify.min.js') }}"></script>

    <!-- Daterangepicker JavaScript -->
    <script src="{{ asset('backend/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Form Flie Upload Data JavaScript -->
    <script src="{{ asset('backend/dist/js/slugify.js') }}"></script>
    <script src="{{ asset('backend/dist/js/validation-data.js') }}"></script>
    <script>
        $(document).ready(function() {
            console.log($('.dropify').dropify())
            $('.dropify').dropify();
        });
    </script>

@endsection
