<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillStoreRequest;
use App\Http\Requests\BillUpdateRequest;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Book;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Repositories\Bill\BillRepository;
use App\Repositories\Book\BookRepository;
use App\Repositories\BillDetail\BillDetailRepository;

class ReportRebtController extends Controller
{
    /**
     * @var BillRepositoryInterface|\App\Repositories\Repository
    */
    /**
     * @var BookRepositoryInterface|\App\Repositories\Repository
    */
    /**
     * @var BillDetailRepositoryInterface|\App\Repositories\Repository
    */
    protected $billRepository;
    protected $bookRepository;
    protected $billDetailRepository;

    public function __construct(BillRepository $billRepository, BookRepository $bookRepository, BillDetailRepository $billDetailRepository)
    {
        $this->billRepository = $billRepository;
        $this->bookRepository = $bookRepository;
        $this->billDetailRepository = $billDetailRepository;
    }


    /**
     * Display a listing of
     *
     * @return View
     */
    public function index()
    {
        $bill = [];
        return view('reportRebt.index')->with('bill', $bill);
    }
}


