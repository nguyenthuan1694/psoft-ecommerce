<?php
namespace App\Repositories\Receipt;

interface ReceiptRepositoryInterface
{
    public function getReceiptWidthPagination();
    
    public function deleteReceipt($id);

    public function trashedReceipt();

    public function restoreReceipt($id);

    public function onlyTrashedReceipt($id);

    public function getReceiptBySlug($slug);
    
    public function getReceiptOtherSlug($slug);
}