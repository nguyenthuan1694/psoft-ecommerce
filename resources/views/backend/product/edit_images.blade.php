@extends('backend.layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title">
                            Cập nhật hình ảnh sản phẩm
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Height</th>
                                        <th>Width</th>
                                        <th>Size</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Image</th>
                                        <th>Height</th>
                                        <th>Width</th>
                                        <th>Size</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($product->images as $index => $image)
                                    <tr>
                                        <td><img src="{{ asset('../storage/app/'.$image->url) }}" width="100" alt="" /></td>
                                        <td>{{ $image->height }} px</td>
                                        <td>{{ $image->width }} px</td>
                                        <td>{{ $image->size }} Kb</td>
                                        <td class="text-right">
                                            <a href="javascript:void(0)" class="btn btn-link btn-danger btn-just-icon" data-toggle="modal" data-target="#delete_modal_{{ $index }}">
                                                <i class="material-icons" title="Delete">delete</i>
                                            </a>
                                            @include('backend.includes.modal_delete_confirm', ['index' => $index, 'item' => $image, 'type' => 'image'])
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <section class="hk-sec-wrapper col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">image</i>
                        </div>
                        <h4 class="card-title">
                            Upload new images
                        </h4>
                    </div>
                    <div class="col-md-12 text-center">
                        <button id="btnSubmit" class="btn btn-success btn-rounded"> <i class="icon" data-icon="&#xe055;"></i> UPLOAD</button>
                    </div>
                    <div class="card-body">
                        <form id="uploadImage" action="{{ route('products.addImages', ['product' => $product]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="dropzone" id="remove_link">
                                        <div class="fallback">
                                            <input name="images" type="file" multiple />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="file" name="images[]" multiple class="d-none">
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


@endsection

@section('css')
    <!-- Bootstrap Dropzone CSS -->
    <link href="{{ asset('backend/vendors/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('script')
    <!-- Dropzone JavaScript -->
    <script src="{{ asset('backend/vendors/dropzone/dist/dropzone.js') }}"></script>

    <script>
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

    <script>
        $('#btnSubmit').click(function () {
            $('#uploadImage').submit();
        });
    </script>
@endsection