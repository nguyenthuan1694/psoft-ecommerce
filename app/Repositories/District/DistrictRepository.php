<?php
namespace App\Repositories\District;

use App\Repositories\BaseRepository;
use App\Models\District;

class DistrictRepository extends BaseRepository implements DistrictRepositoryInterface
{
    public function getModel()
    {
        return District::class;
    }

    // get District by id
    public function getDistrictById()
    {
        return $this->model->where('parent_code', '01')->orderBy('name')->get();
    }

    // get District by code
    public function getDistrictByCode($code)
    {
        return $this->model->where('code', $code)->first()->name_with_type;
    }
}