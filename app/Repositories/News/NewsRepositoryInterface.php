<?php
namespace App\Repositories\News;

interface NewsRepositoryInterface
{
    public function getNewsWidthPagination();
    
    public function deleteNews($id);

    public function trashedNews();

    public function restoreNews($id);

    public function onlyTrashedNews($id);

    public function getNewsBySlug($slug);
    
    public function getNewsOtherSlug($slug);
}