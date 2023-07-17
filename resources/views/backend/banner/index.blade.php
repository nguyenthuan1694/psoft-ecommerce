@extends('backend.layouts.app') @section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="hk-pg-header">
                    <div class="d-flex">
                        <a href="{{ route('banners.create') }}" class="btn btn-info small">Thêm mới banner</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title">
                            Danh sách banner
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="disabled-sorting">#</th>
                                        <th>Thumbnail</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Thumbnail</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($banners as $index => $items)
                                    <tr>
                                        <td>{{ $items->id }}</td>
                                        <td><img src="{{ asset('../storage/app/'.$items->thumbnail) }}" class="img-fluid img-thumbnail" height="100" width="100" alt="img" /></td>
                                        <td>{{ $items->title }}</td>
                                        <td>{!! $items->status_label !!}</td>
                                        <td>{{ $items->created_at->diffForHumans() }}</td>
                                        <td>{{ $items->updated_at->diffForHumans() }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('banners.edit', ['banner' => $items->id]) }}" class="btn btn-link btn-info btn-just-icon edit" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <a onclick="moveToTrash({{ $index }})" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Move to trash">
                                                <i class="material-icons text-danger" data-toggle="tooltip" data-placement="top" title="Delete">delete</i>
                                            </a>
                                            <form name="trash_{{ $index }}" action="{{ route('banners.destroy', ['banner' => $items]) }}" method="post">
                                                @csrf @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach @if(!count($banners))
                                    <td colspan="9" class="text-center">
                                        <h3><i class="linea-icon linea-basic" data-icon="f"></i></h3>
                                        No Data
                                    </td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection @section('script')
<!-- Data Table JavaScript -->
<script src="{{ asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net-dt/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('backend/vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('backend/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
{{--
<script src="{{ asset('backend/dist/js/dataTables-data.js') }}"></script>
--}}

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
</script>
@endsection
