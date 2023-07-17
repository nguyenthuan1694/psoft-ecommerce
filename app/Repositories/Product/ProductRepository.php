<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    public function getProductWidthPagination()
    {
        return $this->model->paginate(config('common.pagination.backend'));
    }

    public function getProductBySlug($slug)
    {
        return $this->model->where('slug', '=', $slug)->first();
    }

    public function getProductOtherSlug($slug)
    {
        return $this->model->where('slug', '<>', $slug)->get();
    }

    public function getProuctById($id)
    {
        return $this->model->where('id',$id)->first();
    }

    public function findProductById($id)
    {
        return $this->model->find($id);
    }
}