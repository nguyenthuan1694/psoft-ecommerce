<?php
namespace App\Repositories\District;

interface DistrictRepositoryInterface
{
    public function getDistrictById();

    public function getDistrictByCode($code);
}