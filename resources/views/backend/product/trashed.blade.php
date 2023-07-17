@extends('backend.layouts.app') @section('content')
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
                            Danh sách sản phẩm đã hủy
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="disabled-sorting">#</th>
                                        <th>Name</th>
                                        <th>Thumbnail</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Parent Category</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($products as $index => $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td><img src="{{ asset('../storage/app/'.$product->thumbnail) }}" class="img-fluid img-thumbnail" height="100" width="100" alt="img" /></td>
                                        <td>{!! $product->status_label !!}</td>
                                        <td>{{ $product->created_at->diffForHumans() }}</td>
                                        <td>{{ $product->updated_at->diffForHumans() }}</td>
                                        <td class="text-right">
                                            <a href="javascript:void(0)" onclick="restore({{ $index }})" class="btn btn-link btn-info btn-just-icon edit" data-toggle="tooltip" data-placement="top" title="Restore">
                                                <i class="material-icons">restore</i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-link btn-danger btn-just-icon" data-toggle="modal" data-target="#delete_modal_{{ $index }}">
                                                <i class="material-icons" title="Delete">delete</i>
                                            </a>
                                            <form name="restore_{{ $index }}" action="{{ route('products.restore', ['id' => $product->id]) }}" method="post">
                                                @csrf @method('PUT')
                                            </form>
                                            @include('backend.includes.modal_delete_confirm', ['index' => $index, 'item' => $product, 'type' => 'product'])
                                        </td>
                                    </tr>
                                    @endforeach @if(!count($products))
                                    <td colspan="8" class="text-center">
                                        <h3><i class="linea-icon linea-basic" data-icon="f"></i></h3>
                                        No Data
                                    </td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end content-->
                    <div class="row">
                        <div class="col-7">
                            <div class="float-left">
                                {!! $products->total() !!} trashed products
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="float-right">
                                {!! $products->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection @section('script')
<script>
    $(document).ready(function () {
        $("#datatables").DataTable({
            pagingType: "full_numbers",
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            },
        });

        var table = $("#datatable").DataTable();

        // Edit record
        table.on("click", ".edit", function () {
            $tr = $(this).closest("tr");
            var data = table.row($tr).data();
            alert("You press on Row: " + data[0] + " " + data[1] + " " + data[2] + "'s row.");
        });

        // Delete a record
        table.on("click", ".remove", function (e) {
            $tr = $(this).closest("tr");
            table.row($tr).remove().draw();
            e.preventDefault();
        });

        //Like record
        table.on("click", ".like", function () {
            alert("You clicked on Like button");
        });
    });

    function moveToTrash(index) {
        let form = "trash_" + index;
        $(`form[name=${form}]`).submit();
    }

    function restore(index) {
        let form = "restore_" + index;
        $(`form[name=${form}]`).submit();
    }
</script>
@endsection
