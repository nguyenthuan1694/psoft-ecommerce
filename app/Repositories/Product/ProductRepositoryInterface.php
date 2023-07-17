<?php
namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function getProductWidthPagination();

    public function getProductBySlug($slug);

    public function getProductOtherSlug($slug);

    public function getProuctById($id);

    public function findProductById($id);
}