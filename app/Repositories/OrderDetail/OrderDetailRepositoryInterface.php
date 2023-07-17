<?php
namespace App\Repositories\OrderDetail;

interface OrderDetailRepositoryInterface
{
    public function getOrderDetailByOrderId($orderId);
}