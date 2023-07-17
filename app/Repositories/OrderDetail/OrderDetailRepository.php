<?php
namespace App\Repositories\OrderDetail;

use App\Repositories\BaseRepository;
use App\Models\OrderDetail;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return OrderDetail::class;
    }

    public function getOrderDetailByOrderId($orderId)
    {
        return $this->model->where('order_id', $orderId)->get();
    }
}