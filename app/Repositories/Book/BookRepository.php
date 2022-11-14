<?php
namespace App\Repositories\Book;

use App\Repositories\BaseRepository;
use App\Models\Book;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Book::class;
    }

    // get book width pagination    
    public function getBookWidthPagination()
    {
        return $this->model->paginate(config('common.pagination.backend'));
    }

    // Delete Book where $id
    public function deleteBook($id)
    {
        return  $this->model->where('id',$id)->first()->delete();
    }

     // Trashed Book
    public function trashedBook()
    {
        return  $this->model->onlyTrashed()->paginate(config('common.pagination.backend'));
    }

     // Restore Book where $id
    public function restoreBook($id)
    {
        return  $this->model->onlyTrashed()->where('id', $id)->first();
    }

     // OnlyTrashed Book where $id
    public function onlyTrashedBook($id)
    {
        return  $this->model->onlyTrashed()->where('id', $id)->first();
    }

    // get Book by $slug
    public function getBookBySlug($slug)
    {
        return $this->model->where('slug', '=', $slug)->first();
    }

    // get Book other $slug
    public function getBookOtherSlug($slug)
    {
        return $this->model->where('slug', '<>', $slug)->orderBy('created_at','DESC')->get();
    }
}