<?php
namespace App\Repositories\News;

use App\Repositories\BaseRepository;
use App\Models\News;

class NewsRepository extends BaseRepository implements NewsRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return News::class;
    }

    // get news width pagination    
    public function getNewsWidthPagination()
    {
        return $this->model->paginate(config('common.pagination.backend'));
    }

    // Delete News where $id
    public function deleteNews($id)
    {
        return  $this->model->where('id',$id)->first()->delete();
    }

     // Trashed News
    public function trashedNews()
    {
        return  $this->model->onlyTrashed()->paginate(config('common.pagination.backend'));
    }

     // Restore News where $id
    public function restoreNews($id)
    {
        return  $this->model->onlyTrashed()->where('id', $id)->first();
    }

     // OnlyTrashed News where $id
    public function onlyTrashedNews($id)
    {
        return  $this->model->onlyTrashed()->where('id', $id)->first();
    }

    // get news by $slug
    public function getNewsBySlug($slug)
    {
        return $this->model->where('slug', '=', $slug)->first();
    }

    // get news other $slug
    public function getNewsOtherSlug($slug)
    {
        return $this->model->where('slug', '<>', $slug)->orderBy('created_at','DESC')->get();
    }
}