<?php
namespace App\Repositories\Receipt;

use App\Repositories\BaseRepository;
use App\Models\Receipt;

class ReceiptRepository extends BaseRepository implements ReceiptRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Receipt::class;
    }

    // get bill width pagination    
    public function getReceiptWidthPagination()
    {
        return $this->model->paginate(config('common.pagination.backend'));
    }

    // Delete Book where $id
    public function deleteReceipt($id)
    {
        return  $this->model->where('id',$id)->first()->delete();
    }

     // Trashed Receipt
    public function trashedReceipt()
    {
        return  $this->model->onlyTrashed()->paginate(config('common.pagination.backend'));
    }

     // Restore Receipt where $id
    public function restoreReceipt($id)
    {
        return  $this->model->onlyTrashed()->where('id', $id)->first();
    }

     // OnlyTrashed Receipt where $id
    public function onlyTrashedReceipt($id)
    {
        return  $this->model->onlyTrashed()->where('id', $id)->first();
    }

    // get Receipt by $slug
    public function getReceiptBySlug($slug)
    {
        return $this->model->where('slug', '=', $slug)->first();
    }

    // get Receipt other $slug
    public function getReceiptOtherSlug($slug)
    {
        return $this->model->where('slug', '<>', $slug)->orderBy('created_at','DESC')->get();
    }
}