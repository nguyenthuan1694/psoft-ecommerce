<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" >Chi tiết đơn hàng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody class="order-body">
                    @foreach(json_decode($orderDetails) as $item)
                        <tr>
                            <td><img src="{{ asset('../storage/app/'.$item->order_thumbnail) }}" class="img-fluid img-thumbnail" height="100" width="100" alt="img"></td>
                            <td>{{ $item->order_name }}</td>
                            <td>{{ $item->order_quantity }}</td>
                            <td>{{ number_format($item->order_price, 0) }} vnđ</td>
                            <td>{{ number_format($item->order_total_price, 0) }} vnđ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light small" data-dismiss="modal">Đóng</button>
        </div>
        </div>
    </div>
</div>