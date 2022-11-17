<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillStoreRequest;
use App\Http\Requests\BillUpdateRequest;
use App\Models\Receipt;
use App\Models\BillDetail;
use App\Models\Book;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Repositories\Receipt\ReceiptRepository;

class ReportRebtController extends Controller
{
    /**
     * @var ReceiptRepositoryInterface|\App\Repositories\Repository
    */
    protected $receiptRepository;

    public function __construct(ReceiptRepository $receiptRepository)
    {
        $this->receiptRepository = $receiptRepository;
    }


    /**
     * Display a listing of
     *
     * @return View
     */
    public function index()
    {
        $receipts = $this->receiptRepository->getReceiptWidthPagination();
        return view('reportRebt.index')->with('receipts', $receipts);
    }
}


