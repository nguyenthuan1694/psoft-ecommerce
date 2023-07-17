<?php
namespace App\Repositories\Ward;

interface WardRepositoryInterface
{
    public function getWardById();

    public function getWardByCode($code);
}