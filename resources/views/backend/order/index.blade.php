@extends('backend.layouts.app') @section('content')
<input class="url" type="hidden" value="{{ route('orders.showOrderDetail') }}">
{{ csrf_field() }}
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
                            Danh sách đơn đặt hàng
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th style="width: 15%">Địa chỉ</th>
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
                                        <th style="width: 15%">Địa chỉ</th>
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
                                        <td>
                                            <a href="#" data-toggle="tooltip" title="click update status" data-placement="top" onclick="updateStatusPayment(this)">{!! $order->payment_status_text !!}</a>
                                            <select onchange="paymentChange(this)" data-id="{{ $order->id }}" hidden style="font-size: 14px;" class="form-control custom-select" name="" id="statusShipping">
                                                <option value="" selected>Chọn trạng thái</option>
                                                <option value="1"><span class="badge badge-info">Chưa thanh toán</span></option>
                                                <option value="2"><span class="badge badge-warning">Đã thanh toán</span></option>
                                                <option value="3"><span class="badge badge-success">Trả hàng</span></option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="tooltip" title="click update status" data-placement="top" onclick="updateStatus(this)">{!! $order->shipping_status_text !!}</a>
                                            <select onchange="shippingChange(this)" data-id="{{ $order->id }}" hidden style="font-size: 14px;" class="form-control custom-select" name="" id="statusShipping">
                                                <option value="" selected>Chọn trạng thái</option>
                                                <option value="1"><span class="badge badge-info">Đang kiểm tra hàng</span></option>
                                                <option value="2"><span class="badge badge-warning">Đang gửi</span></option>
                                                <option value="3"><span class="badge badge-success">Gửi thành công</span></option>
                                                <option value="4"><span class="badge badge-danger">Gửi thất bại</span></option>
                                            </select>
                                        </td>
                                        <td>{{ $order->created_at->diffForHumans() }}</td>
                                        <td>{{ $order->updated_at->diffForHumans() }}</td>
                                        <td class="text-right">
                                            <a href="#" onclick="loadModal({{ $order->id }})" title="View">
                                                <i class="material-icons">remove_red_eye</i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger delete" data-toggle="tooltip" data-placement="top" title="Move to trash" onclick="moveToTrash({{ $index }})">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <form name="trash_{{ $index }}" action="{{ route('orders.destroy', ['order' => $order]) }}" method="post">
                                                @csrf @method('DELETE')
                                            </form>
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
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- Modal -->
    @include('backend.includes.modal_order_detail')
</div>
@endsection 
@section('script')

<!-- script order -->
<script type="text/javascript" src="{{ asset('backend/js/order.js') }}"></script>
<script>
        function updateStatus(obj)
        {
            var parent =$(obj).attr("hidden","hidden");
            var selectParent = parent.next().removeAttr("hidden");
        }

        function updateStatusPayment(obj)
        {
            var parent =$(obj).attr("hidden","hidden");
            var selectParent = parent.next().removeAttr("hidden");
        }

        function shippingChange(obj)
        {
            var orderId = $(obj).attr('data-id');
            var selected =  $(obj).children("option:selected").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('orders.updateShipping') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    shipping_status: selected,
                    id: orderId,
                }
            }).then(function (res) {
                var parent =  $(obj).attr("hidden","hidden");
                parent.prev().removeAttr("hidden");
                location.reload();
            })
        }

        function paymentChange(obj)
        {
            var status = $(obj).attr('data-value');
            var orderId = $(obj).attr('data-id');
            var selected =  $(obj).children("option:selected").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('orders.updatePayment') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    payment_status: selected,
                    id: orderId,
                }
            }).then(function (res) {
                var parent =  $(obj).attr("hidden","hidden");
                parent.prev().removeAttr("hidden");
                location.reload();
            })
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
        let form = 'trash_' + index;
        $(`form[name=${form}]`).submit();
      }
</script>
@endsection
