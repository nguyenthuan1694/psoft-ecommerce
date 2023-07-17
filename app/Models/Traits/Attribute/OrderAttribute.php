<?php

namespace App\Models\Traits\Attribute;

trait OrderAttribute
{
    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case config('common.order.status.ordered'):
                return '<span class="badge badge-success">Đã đặt hàng</span>';
            case config('common.order.status.processing'):
                return '<span class="badge badge-info">Đang xử lý</span>';
            case config('common.order.status.cancelled'):
                return '<span class="badge badge-warning">Hủy</span>';
            case config('common.order.status.done'):
                return '<span class="badge badge-success">Thành công</span>';
            default:
                return '<span class="badge badge-danger">Thất bại</span>';
        }
    }

    public function getShippingStatusTextAttribute()
    {
        switch ($this->shipping_status) {
           
            case config('common.shipping.status.are_checking'):
                return '<span class="badge badge-info">Đang kiểm tra hàng</span>';
            case config('common.shipping.status.sending'):
                return '<span class="badge badge-warning">Đang gửi</span>';
            case config('common.shipping.status.done'):
                return '<span class="badge badge-success">Gửi thành công</span>';
            default:
                return '<span class="badge badge-danger">Gửi thất bại</span>';
        }
    }

    public function getPaymentStatusTextAttribute()
    {
        switch ($this->payment_status) {
            case config('common.payment.status.unpaid'):
                return '<span class="badge badge-warning">Chưa thanh toán</span>';
            case config('common.payment.status.paid'):
                return '<span class="badge badge-success">Đã thanh toán</span>';
            default:
                return '<span class="badge badge-danger">Trả hàng</span>';
        }
    }

    public function getShippingMethodTextAttribute()
    {
        switch ($this->shipping_method_id)
        {
            case config('common.shipping.method.standard'):
                return 'Standard';
        }
    }
}
