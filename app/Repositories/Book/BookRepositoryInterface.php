<?php
namespace App\Repositories\Book;

interface BookRepositoryInterface
{
    public function getBookWidthPagination();
    
    public function deleteBook($id);

    public function trashedBook();

    public function restoreBook($id);

    public function onlyTrashedBook($id);

    public function getBookBySlug($slug);
    
    public function getBookOtherSlug($slug);
}