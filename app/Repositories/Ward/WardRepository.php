<?php
namespace App\Repositories\Ward;

use App\Repositories\BaseRepository;
use App\Models\Ward;

class WardRepository extends BaseRepository implements WardRepositoryInterface
{
    public function getModel()
    {
        return Ward::class;
    }

    // get Ward by Id
    public function getWardById()
    {
        return $this->model->where('parent_code', '01')->orderBy('name')->get();
    }

    // get Ward by code
    public function getWardByCode($code)
    {
        return $this->model->where('code', $code)->first()->name_with_type;
    }
}