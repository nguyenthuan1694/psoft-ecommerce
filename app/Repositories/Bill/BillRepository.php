<?php
namespace App\Repositories\Bill;

use App\Repositories\BaseRepository;
use App\Models\Bill;

class BillRepository extends BaseRepository implements BillRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Bill::class;
    }

    // get bill width pagination    
    public function getBillWidthPagination()
    {
        return $this->model->paginate(config('common.pagination.backend'));
    }

    // Delete Book where $id
    public function deleteBill($id)
    {
        return  $this->model->where('id',$id)->first()->delete();
    }

     // Trashed Bill
    public function trashedBill()
    {
        return  $this->model->onlyTrashed()->paginate(config('common.pagination.backend'));
    }

     // Restore Bill where $id
    public function restoreBill($id)
    {
        return  $this->model->onlyTrashed()->where('id', $id)->first();
    }

     // OnlyTrashed Bill where $id
    public function onlyTrashedBill($id)
    {
        return  $this->model->onlyTrashed()->where('id', $id)->first();
    }

    // get Bill by $slug
    public function getBillBySlug($slug)
    {
        return $this->model->where('slug', '=', $slug)->first();
    }

    // get Bill other $slug
    public function getBillOtherSlug($slug)
    {
        return $this->model->where('slug', '<>', $slug)->orderBy('created_at','DESC')->get();
    }
}