<?php
namespace App\Repositories\BillDetail;

use App\Repositories\BaseRepository;
use App\Models\BillDetail;

class BillDetailRepository extends BaseRepository implements BillDetailRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return BillDetail::class;
    }

    // get BillDetail width pagination    
    public function getBillDetailWidthPagination()
    {
        return $this->model->where('status', 0)->with('books')->paginate(config('common.pagination.backend'));
    }

    // Delete BillDetail where $id
    public function deleteBillDetail($id)
    {
        return  $this->model->where('id',$id)->first()->delete();
    }

     // Trashed BillDetail
    public function trashedBillDetail()
    {
        return  $this->model->onlyTrashed()->paginate(config('common.pagination.backend'));
    }

     // Restore BillDetail where $id
    public function restoreBillDetail($id)
    {
        return  $this->model->onlyTrashed()->where('id', $id)->first();
    }

     // OnlyTrashed BillDetail where $id
    public function onlyTrashedBillDetail($id)
    {
        return  $this->model->onlyTrashed()->where('id', $id)->first();
    }

    // get BillDetail by $slug
    public function getBillDetailBySlug($slug)
    {
        return $this->model->where('slug', '=', $slug)->first();
    }

    // get BillDetail other $slug
    public function getBillDetailOtherSlug($slug)
    {
        return $this->model->where('slug', '<>', $slug)->orderBy('created_at','DESC')->get();
    }
}