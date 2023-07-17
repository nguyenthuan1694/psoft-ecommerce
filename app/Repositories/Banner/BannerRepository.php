<?php
namespace App\Repositories\Banner;

use App\Repositories\BaseRepository;
use App\Models\Banner;

class BannerRepository extends BaseRepository implements BannerRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Banner::class;
    }

    // get banner width pagination    
    public function getBannerWidthPagination()
    {
        return $this->model->paginate(config('common.pagination.backend'));
    }

    // Delete Book where $id
    public function deleteBanner($id)
    {
        return  $this->model->where('id',$id)->first()->delete();
    }

     // Trashed Banner
    public function trashedBanner()
    {
        return  $this->model->onlyTrashed()->paginate(config('common.pagination.backend'));
    }

     // Restore Banner where $id
    public function restoreBanner($id)
    {
        return  $this->model->onlyTrashed()->where('id', $id)->first();
    }

     // OnlyTrashed Banner where $id
    public function onlyTrashedBanner($id)
    {
        return  $this->model->onlyTrashed()->where('id', $id)->first();
    }

    // get Banner by $slug
    public function getBannerBySlug($slug)
    {
        return $this->model->where('slug', '=', $slug)->first();
    }

    // get Banner other $slug
    public function getBannerOtherSlug($slug)
    {
        return $this->model->where('slug', '<>', $slug)->orderBy('created_at','DESC')->get();
    }
}