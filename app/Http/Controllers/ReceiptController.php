<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceiptStoreRequest;
use App\Http\Requests\ReceiptUpdateRequest;
use App\Models\Receipt;
use App\Models\BillDetail;
use App\Models\Book;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Repositories\Receipt\ReceiptRepository;
use App\Repositories\Book\BookRepository;
use App\Repositories\BillDetail\BillDetailRepository;

class ReceiptController extends Controller
{
    /**
     * @var ReceiptRepositoryInterface|\App\Repositories\Repository
    */
    /**
     * @var BookRepositoryInterface|\App\Repositories\Repository
    */
    /**
     * @var BillDetailRepositoryInterface|\App\Repositories\Repository
    */
    protected $receiptRepository;
    protected $bookRepository;
    protected $billDetailRepository;

    public function __construct(ReceiptRepository $receiptRepository, BookRepository $bookRepository, BillDetailRepository $billDetailRepository)
    {
        $this->receiptRepository = $receiptRepository;
        $this->bookRepository = $bookRepository;
        $this->billDetailRepository = $billDetailRepository;
    }

 
    /**
     * Display a listing of products.
     *
     * @return View
     */
    public function index()
    {
        $receipts = $this->receiptRepository->getReceiptWidthPagination();
        // dd($bill);
        return view('receipt.index')->with('receipts', $receipts);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return View
     */
    public function create()
    {
        $listBill = $this->billDetailRepository->getAll();
        // $listBill = BillDetail::where('amount_owed', '>', 0)->get();
        return view('receipt.create')
            ->with('listBill', $listBill)
            // ->with('receipts', $receipts)
        ;
    }

    /**
     * Store a new product.
     *
     * @param ReceiptStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ReceiptStoreRequest $request)
    {
        $data = $request->all();
        $listReceipts = $this->receiptRepository->getAll();
        $messages = true;
        if(!empty($listReceipts)) {
            foreach($listReceipts as $value) {
                if($value->full_name == $data['full_name']) {
                    if($data['proceeds'] <= $value->amount_owed)
                    {
                        $messages = true;
                    } else {
                        $messages = false;
                    }
                }
            }
        }
        $receiptData = [
            'bill_id' => $data['bill_id'],
            'book_id' => $data['book_id'],
            'full_name' => $data['full_name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'fall_day' => $data['fall_day'],
            'proceeds' => $data['proceeds'],
            'amount_owed' => !empty($data['amount_owed']) ? $data['amount_owed'] : 0,
        ];
        if($messages == true) {
            $this->receiptRepository->create($receiptData);
            $this->billDetailRepository->update($data['id_bill_detail'], ['status' => 1]);
            return redirect()->route('receipt.index')
                ->with('success', 'Bạn đã lập phiếu thu thành công');
        } else {
            return redirect()->route('receipt.index')
                ->with('danger', 'Vui lòng nhập số tiền thu không vượt quá số tiền nợ');
        }
    }

    /**
     * Show the form for editing the news.
     *
     * @param Receipt $receipt
     * @return View
     */
    public function edit(Receipt $receipt)
    {
        $listBill = $this->billDetailRepository->getAll();
        return view('receipt.edit')
            ->with('receipt', $receipt)
            ->with('listBill', $listBill);
    }

    /**
     * Update the bill.
     *
     * @param Request $request
     * @param Bill $bill
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $dataReceipt = [
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'fall_day' => $data['fall_day'],
            'proceeds' => $data['proceeds'],
            'amount_owed' => !empty($data['amount_owed']) ? $data['amount_owed'] : 0,
        ];
        $this->receiptRepository->update($data['id'], $dataReceipt);
        return redirect()->route('receipt.index')->with('success', 'Bạn đã cập nhật phiếu thu thành công');
    }

     /**
     * Display the news.
     *
     * @param News $news
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Move the news to trash.
     *
     * @param Book $book
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Book $book)
    {
        dd('aa');
        $this->bookRepository->deleteBook($book['id']);
        return redirect()->back()->with('success', 'Bạn đã xóa sách thành công');
    }

    /**
     * Display a listing of the trashed book.
     *
     * @return View
     */
    public function trashed()
    {
        dd('qq');
        $book = $this->bookRepository->trashedBook();
        return view('book.trashed')->with('book', $book);
    }

    /**
     * Restored a trashed book.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(Request $request, $id)
    {
        $book = $this->bookRepository->restoreBook($id);
        $book->restore();
        return redirect()->back()->with('success', 'Bạn đã khôi phục sách thành công');
    }

    /**
     * Force delete a trashed book.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function forceDelete($id)
    {
        $receipt = Receipt::where('id', $id)->first();
        $receipt->forceDelete();
        return redirect()->back()->with('success', 'Bạn đã xóa phiếu thu thành công');
    }
}


