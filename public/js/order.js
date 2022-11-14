
var url = $('.url').val();
var _token = $('[name = _token]').val();
function moveToTrash(index) {
    let form = 'trash_' + index;
    $(`form[name=${form}]`).submit();
}

function loadModal(orderId) {
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            _token: _token,
            id: orderId
        }
    }).then(function (res) {
        $('#exampleModalLabel').modal('show');
        $('.order-body').html(function () {
            let html = '';
            res.data.orderDetail.forEach(function (e) {
                var total = new Intl.NumberFormat('en').format(e.quantity * e.price);
                var quantity = new Intl.NumberFormat('en').format(e.quantity);
                var price = new Intl.NumberFormat('en').format(e.price);
                var thumbnail = e.products.thumbnail;
                html = html +
                    `<tr>
                        <td><img src="${thumbnail}" class="img-fluid img-thumbnail" height="100" width="100" alt="img"></td>
                        <td>${e.name}</td>
                        <td>${quantity}</td>
                        <td>${price}</td>
                        <td>${total}</td>
                    </tr>`;
            });
            return html;
        });
    });
}