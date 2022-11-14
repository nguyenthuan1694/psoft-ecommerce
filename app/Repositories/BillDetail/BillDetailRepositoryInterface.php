<?php
namespace App\Repositories\BillDetail;

interface BillDetailRepositoryInterface
{
    public function getBillDetailWidthPagination();
    
    public function deleteBillDetail($id);

    public function trashedBillDetail();

    public function restoreBillDetail($id);

    public function onlyTrashedBillDetail($id);

    public function getBillDetailBySlug($slug);
    
    public function getBillDetailOtherSlug($slug);
}