<?php
namespace App\Repositories\Province;

interface ProvinceRepositoryInterface
{
    public function getProvinceOrderByName();

    public function getProvinceByCode($code);
}