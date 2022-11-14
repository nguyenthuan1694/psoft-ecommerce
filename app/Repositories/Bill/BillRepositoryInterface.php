<?php
namespace App\Repositories\Bill;

interface BillRepositoryInterface
{
    public function getBillWidthPagination();
    
    public function deleteBill($id);

    public function trashedBill();

    public function restoreBill($id);

    public function onlyTrashedBill($id);

    public function getBillBySlug($slug);
    
    public function getBillOtherSlug($slug);
}