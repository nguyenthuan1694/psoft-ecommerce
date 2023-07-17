<?php
namespace App\Repositories\Order;

use App\Repositories\BaseRepository;
use App\Models\Order;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Order::class;
    }

    public function getOrderWidthPagination()
    {
        return $this->model->paginate(config('common.pagination.backend'));
    }
}