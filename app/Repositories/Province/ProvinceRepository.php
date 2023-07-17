<?php
namespace App\Repositories\Province;

use App\Repositories\BaseRepository;
use App\Models\Province;

class ProvinceRepository extends BaseRepository implements ProvinceRepositoryInterface
{
    public function getModel()
    {
        return Province::class;
    }

    // get province order by name
    public function getProvinceOrderByName()
    {
        return $this->model->orderBy('name')->get();
    }

    // get Province by code
    public function getProvinceByCode($code)
    {
        return $this->model->where('code', $code)->first()->name_with_type;
    }
}