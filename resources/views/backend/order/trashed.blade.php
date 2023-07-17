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
                            Danh sách đơn đặt đã hủy
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th style="width: 15%;">Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Trạng thái</th>
                                        <th>TT thanh toán</th>
                                        <th>TT giao hàng</th>
                                        <th>Ngày tạo</th>
                                        <th>Ngày cập nhật</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th style="width: 15%;">Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Trạng thái</th>
                                        <th>TT thanh toán</th>
                                        <th>TT giao hàng</th>
                                        <th>Ngày tạo</th>
                                        <th>Ngày cập nhật</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($orders as $index => $order)
                                    <tr>
                                        <td>{{ $order->fullname }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{!! $order->status_text !!}</td>
                                        <td>{!! $order->payment_status_text !!}</td>
                                        <td>{!! $order->shipping_status_text !!}</td>
                                        <td>{{ $order->created_at->diffForHumans() }}</td>
                                        <td>{{ $order->updated_at->diffForHumans() }}</td>
                                        <td class="text-right">
                                            <a href="javascript:void(0)" onclick="restore({{ $index }})" title="Restore">
                                                <i class="material-icons">restore</i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger delete" data-toggle="modal" data-target="#delete_modal_{{ $index }}">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <form name="restore_{{ $index }}" action="{{ route('orders.restore', ['id' => $order->id]) }}" method="post">
                                                @csrf @method('PUT')
                                            </form>
                                            @include('backend.includes.modal_delete_confirm', ['index' => $index, 'item' => $order, 'type' => 'orders'])
                                        </td>
                                    </tr>
                                    @endforeach @if(!count($orders))
                                    <td colspan="10" class="text-center">
                                        <h3><i class="linea-icon linea-basic" data-icon="f"></i></h3>
                                        No Data
                                    </td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('script')
<script>
    function restore(index) {
        let form = "restore_" + index;
        $(`form[name=${form}]`).submit();
    }

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
