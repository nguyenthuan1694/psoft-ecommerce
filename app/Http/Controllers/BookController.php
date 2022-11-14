<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Image;
use App\Models\Book;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Repositories\Book\BookRepository;

class BookController extends Controller
{
    /**
     * @var BookRepositoryInterface|\App\Repositories\Repository
    */
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }


    /**
     * Display a listing of products.
     *
     * @return View
     */
    public function index()
    {
        $book = $this->bookRepository->getBookWidthPagination();
        return view('book.index')->with('book', $book);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return View
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a new product.
     *
     * @param BookStoreRequest $request
     * @return RedirectResponse
     */
    public function store(BookStoreRequest $request)
    {
        $data = $request->all();
        $book = $this->bookRepository->getBookWidthPagination();
        $dataNew = [];
        foreach($book as $value) {
            if($data['name'] == $value->name) {
                $dataNew = [
                    'id' => $value->id,
                    'name' => $data['name'],
                    'category' => $data['category'],
                    'author' => $data['author'],
                    'quan_stock_old' => $value->quan_stock,
                    'quan_stock_new' => $data['quan_stock'] + $value->quan_stock,
                ];
            }
        }
        if(empty($dataNew) || $dataNew == '') {
            $this->bookRepository->create($data);
            return redirect()->route('book.index')
                ->with('success', 'Bạn đã nhập sách thành công');
        } else {
            if($dataNew['quan_stock_old'] < 300)  {
                $this->bookRepository->update($dataNew['id'], ['quan_stock' => $dataNew['quan_stock_new']]);
                return redirect()->route('book.index')
                    ->with('success', 'Bạn đã nhập sách thành công');
            } else {
                return redirect()->route('book.index')
                    ->with('danger', 'không thể nhập sách vì số lượng tồn phải nhỏ hơn 300');
            }
        }
    }

    /**
     * Show the form for editing the news.
     *
     * @param Book $book
     * @return View
     */
    public function edit(Book $book)
    {
        return view('book.edit')
            ->with('book', $book);
    }

    /**
     * Update the book.
     *
     * @param BookUpdateRequest $request
     * @param Book $book
     * @return RedirectResponse
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $this->bookRepository->update($book->id, $request->all());
        return redirect()->route('book.index')->with('success', 'Bạn đã cập nhật sách thành công');
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
        $book = Book::where('id', $id)->first();
        $book->forceDelete();
        return redirect()->back()->with('success', 'Bạn đã xóa sách thành công');
    }
}


