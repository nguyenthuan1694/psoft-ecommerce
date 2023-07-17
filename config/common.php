<?php

return [
    'product' => [
        'status' => [
            'Active' => 1,
            'unActive' => 0,
        ],
        'type' => [
            'Sản phẩm mặc định' => 0,
            'Sản phẩm nổi bật' => 1,
            'Sản phẩm bán chạy' => 2,
        ],
        // 'weight_unit' => [
        //     'gram' => 1,
        //     'kilogram' => 2,
        // ],
        // 'dimension_unit' => [
        //     'millimeter' => 1,
        //     'centimeter' => 2,
        //     'meter' => 3,
        // ],
        'virtual' => [
            'physical' => 1,
            'download' => 2,
            'only_view' => 3,
            'service' => 4,
        ],
    ],
    'comment' => [
        'status' => [
            'active' => 1,
            'unActive' => 0,
        ],
    ],
    'pagination' => [
        'backend' => 10,
        'frontend' => 7,
    ],
    'coupon' => [
        'type' => [
            'fixed' => 1,
            'percent' => 2,
        ],
        'status' => [
            'used' => 2,
            'active' => 1,
            'unActive' => 0,
        ],
    ],
    'order' => [
        'status' => [
            'ordered' => 1,
            'processing' => 2,
            'cancelled' => 3,
            'done' => 4,
            'failed' => 5,
        ],
    ],
    'shipping' => [
        'default_fee' => 20000,
        'method' => [
            'standard' => 1
        ],
        'status' => [
            'are_checking' => 1,
            'sending' => 2,
            'done' => 3,
            'not_sent' => 4,
        ],
    ],
    'payment' => [
        'method' => [
            'cash' => 1,
        ],
        'status' => [
            'unpaid' => 1,
            // 'partial' => 2,
            'paid' => 2,
            'return' => 3,
        ],
    ],
    'comment_admin' => [
        'user_name' => 'Tư Vấn: 090.8855.483 (Miễn Phí)',
        'phone' => '090888999',
    ],
    'banner' => [
        'status' => [
            'active' => 1,
            'unActive' => 0,
        ],
    ],
    'shipping_policy' => [
        'content' => '<ul>
        <li>Giao hàng toàn quốc với 2 hình thức: Chuyển khoản trước hoặc Thanh toán khi nhận hàng (COD).</li>
        <li>Nhà vận chuyển uy tín: Giaohangnhanh, Ninjavan, GHTK.</li>
        </ul>
        <p><strong>PHÍ VẬN CHUYỂN</strong></p>
        <p>- Toàn Quốc: Đồng giá 30.000đ. Miễn phí vận chuyển cho đơn hàng trên&nbsp;500.000đ. Đơn hàng trên 250.000đ phí chỉ còn 18.000đ.</p>
        <p>- Riêng TPHCM: Đồng giá 17.000đ. Miễn phí vận chuyển cho đơn hàng trên 250.000đ. (*)Trường hợp đổi hàng tận nơi phí 25.000đ.</p>
        <p>Lưu ý:</p>
        <ul>
            <li>Mỗi đơn hàng được giao tối đa 2 lần, nhân viên giao hàng sẽ gọi điện thoại cho khách trước khi giao.&nbsp;(nếu lần đầu giao hàng không thành công, nhân viên giao sẽ liên hệ để sắp xếp lịch giao lần 2)</li>
            <li>Thời gian vận chuyển ước tính:</li>
        </ul>
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <td>Khu Vực</td>
                    <td>Thời Gian</td>
                </tr>
                <tr>
                    <td>TP. Hồ Chí Minh</td>
                    <td>1 - 2 ngày</td>
                </tr>
                <tr>
                    <td>Hà Nội, Đà Nẵng, Miền Nam</td>
                    <td>2 - 3 ngày</td>
                </tr>
                <tr>
                    <td>Các thành phố khác</td>
                    <td>3 - 5 ngày</td>
                </tr>
            </tbody>
        </table>
        <ul>
            <li>&nbsp;</li>
            <li>(*) Thời gian có thể sớm hoặc muộn hơn tùy khu vực nội ô hay ngoại ô.</li>
            <li>(*) Nếu không vừa ý với thái độ nhân viên giao hàng vui lòng liên hệ shop hỗ trợ.</li>
        </ul>
        <p>&ZeroWidthSpace;</p>
        <ul>
            <li>Giờ làm việc và tư vấn khách hàng:<strong>&nbsp;Từ 8giờ sáng đến 5 giờ chiều từ Thứ 2 đến thứ 7.&nbsp;</strong>&ZeroWidthSpace;&nbsp;</li>
            <li>HOTLINE: 1900.636100</li>
            <li>ZALO: 0938100276</li>
        </ul>
        ',
    ],
    'return_policy' => [
        'content' => 'BÉ XINH SHOP hỗ trợ đổi trả sản phẩm với quy trình cực kì đơn giản, dễ dàng cho khách hàng:
        </br>
        - Bước 1: Trong vòng 3 ngày kể từ khi nhận hàng, nếu phát hiện sản phẩm có vấn đề hoặc không vừa ý, khách hàng bỏ sản phẩm vào bao bì kèm giấy tờ nhãn mác như ban đầu.
        </br>
        - Bước 2: Khách hàng liên hệ BÉ XINH SHOP (Facebook hoặc Hotline 1900.636100) để thông báo về trường hợp của mình.
        </br>
        - Bước 3: Cửa hàng đối chiếu và tiến hành đổi sản phẩm hoặc chuyển khoản lại tiền cho khách hàng trong thời gian sớm nhất.
        </br>
        CÁCH ĐỔI HÀNG:
        </br>
        - Khách ở tại TPHCM: Shop hỗ trợ giao hàng tận nơi và lấy hàng đổi về hoặc ghé shop đổi trực tiếp.
        </br>
        - Khách ở toàn quốc: Khách gửi lại cho shop qua đường bưu điện. 
        </br>
        LƯU Ý:
        </br>
        - Sản phẩm đổi trả cần chưa qua sử dụng, không bị bẩn, rách hoặc giặt ủi.</br>
        - Phí ship đổi trả hàng khách hàng phải thanh toán. (Trừ trường hợp hàng lỗi hoặc giao nhầm mẫu).</br>
        - Shop vẫn hỗ trợ phí ship giao đi lại được tính theo Giá đơn hàng = (Giá sản phẩm mới) - (Giá sản phẩm đổi).</br>
        </br>
        - Giờ làm việc và tư vấn khách hàng: Từ 8giờ sáng đến 5 giờ chiều từ Thứ 2 đến thứ 7. ​ </br>
        - HOTLINE: 1900.636100</br>
        - ZALO: 0938100276',
    ],
];
