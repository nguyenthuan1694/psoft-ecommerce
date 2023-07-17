<?php
namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function getCategoryBySlug($slug);
}