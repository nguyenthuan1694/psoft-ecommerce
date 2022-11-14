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

class BillController extends Controller
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
     * Display a listing of products.
     *
     * @return View
     */
    public function index()
    {
        $bill = $this->billDetailRepository->getBillDetailWidthPagination();
        return view('bill.index')->with('bill', $bill);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return View
     */
    public function create()
    {
        $listBook = $this->bookRepository->getAll();
        return view('bill.create')->with('listBook', $listBook);
    }

    /**
     * Store a new product.
     *
     * @param BillStoreRequest $request
     * @return RedirectResponse
     */
    public function store(BillStoreRequest $request)
    {
        $data = $request->all();
        $book = $this->bookRepository->getBookWidthPagination();
        $dataBill = [
            'customer' => $data['customer'],
        ];
        $dataBillID = $this->billRepository->create($dataBill);

        $dataBillDetails = [
            'bill_id' => $dataBillID->id,
            'book_id' => $data['book_id'],
            'amount' => $data['amount'],
            'unit_price' => $data['unit_price'],
        ];
        $dataBook = [];
        foreach($book as $value) {
            if($value->id == $data['book_id']) {
                $dataBook = [
                    'quan_stock_new' => $value->quan_stock - $data['amount'],
                ];
            }   
        }
        $this->bookRepository->update($data['book_id'], ['quan_stock' => $dataBook['quan_stock_new']]);
        $this->billDetailRepository->create($dataBillDetails);
        return redirect()->route('bill.index')
                ->with('success', 'Bạn đã lập hóa đơn thành công');
        // if($dataBook['quan_stock_new'] > 20) {
        //     $dataBill = $this->billRepository->create($data);
        //     $dataBillDetails = [
        //         'bill_id' => $dataBill->id,
        //         'book_id' => $data['book_id'],
        //         'category' => $data['category'],
        //         'amount' => $data['amount'],
        //         'unit_price' => $data['unit_price'],
        //     ];
        //     $this->billRepository->create($dataBookDetails);
        //     $this->bookRepository->update($data['book_id'], ['quan_stock' => $dataBook['quan_stock_new']]);
        //     return redirect()->route('bill.index')
        //         ->with('success', 'Bạn đã lập hóa đơn thành công');
        // } else {
        //     return redirect()->route('bill.index')
        //         ->with('danger', 'không thể lập hóa đơn vì số lượng tồn sách'.$dataBook['name'].' nhỏ hơn 20');
        // }
    }

    /**
     * Show the form for editing the news.
     *
     * @param BillDetail $billDetail
     * @return View
     */
    public function edit($id)
    {
        $bill = BillDetail::where('id', $id)->first();
        $listBook = $this->bookRepository->getAll();
        return view('bill.edit')
            ->with('bill', $bill)
            ->with('listBook', $listBook);
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
        $dataBook = [];
        $dataBill = [
            'customer' => $data['customer'],
        ];
        // update bill
        $this->billRepository->update($data['bill_id'], ['customer' => $dataBill['customer']]);
        // update billDetail
        $dataBilldetail = [
            'bill_id' => $data['bill_id'],
            'book_id' => $data['book_id'],
            'amount' => $data['amount'],
            'unit_price' => $data['unit_price'],
        ];
        $this->billDetailRepository->update($data['id'], $dataBilldetail);
        // update book
        $listBook = Book::where('id', $data['book_id'])->first();
        $quan_stock = ($listBook->quan_stock + $data['amount_old']) - $data['amount'];
        $this->bookRepository->update($data['book_id'], ['quan_stock' => $quan_stock]);

        return redirect()->route('bill.index')->with('success', 'Bạn đã cập nhật hóa đơn thành công');
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
        $bill = Bill::where('id', $id)->first();
        $billDetail = BillDetail::where('bill_id', $id)->first();
        $bill->forceDelete();
        $billDetail->forceDelete();
        return redirect()->back()->with('success', 'Bạn đã xóa sách thành công');
    }
}


