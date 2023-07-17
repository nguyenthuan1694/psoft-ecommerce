<?php
namespace App\Repositories\Banner;

interface BannerRepositoryInterface
{
    public function getBannerWidthPagination();
    
    public function deleteBanner($id);

    public function trashedBanner();

    public function restoreBanner($id);

    public function onlyTrashedBanner($id);

    public function getBannerBySlug($slug);
    
    public function getBannerOtherSlug($slug);
}