<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerStoreRequest;
use App\Http\Requests\BannerUpdateRequest;
use App\Models\Image;
use App\Models\Banner;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Repositories\Banner\BannerRepository;

class BannerController extends Controller
{
    /**
     * @var BannerRepositoryInterface|\App\Repositories\Repository
    */
    protected $bannerRepository;

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }


    /**
     * Display a listing of products.
     *
     * @return View
     */
    public function index()
    {
        $banners = $this->bannerRepository->getBannerWidthPagination();
        return view('backend.banner.index')->with('banners', $banners);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return View
     */
    public function create()
    {
        $allStatus = config('common.banner.status');
        return view('backend.banner.create')
            ->with('allStatus', $allStatus)
        ;
    }

    /**
     * Store a banner product.
     *
     * @param BannerStoreRequest $request
     * @return RedirectResponse
     */
    public function store(BannerStoreRequest $request)
    {
        $banner = $this->bannerRepository->create($request->except(['thumbnail']));
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnailName = generateProductImageName(1,$file->getClientOriginalExtension());
            $thumbnailPath = generateProductImagePath(1);
            $file->storeAs($thumbnailPath, $thumbnailName);
            $banner->thumbnail = $thumbnailPath . '/' .$thumbnailName;
            $banner->save();
        }
        return redirect()->route('banner.index')->with('success', 'Thêm banner thành công !!!');
    }

    /**
     * Show the form for editing the banner.
     *
     * @param Banner $banner
     * @return View
     */
    public function edit(Banner $banner)
    {
        $allStatus = config('common.product.status');
        return view('backend.banner.edit')
            ->with('allStatus', $allStatus)
            ->with('banner', $banner);
    }

    /**
     * Update the banner.
     *
     * @param BannerUpdateRequest $request
     * @param Banner $banner
     * @return RedirectResponse
     */
    public function update(BannerUpdateRequest $request, Banner $banner)
    {
        $this->bannerRepository->update($request->id, $request->except(['thumbnail']));
        if ($request->hasFile('thumbnail')) {
            if (file_exists(public_path() . $banner->thumbnail)) {
                unlink(public_path() . $banner->thumbnail);
            }
            $file = $request->thumbnail;
            $thumbnailName = generateProductImageName($banner->id,$file->getClientOriginalExtension());
            $thumbnailPath = generateProductImagePath($banner->id);
            $file->storeAs($thumbnailPath, $thumbnailName);
            $banner->thumbnail = $thumbnailPath . '/' .$thumbnailName;
            $banner->save();
        }
        return redirect()->route('banner.index')->with('success', 'Cập nhật banner thành công !');
    }

     /**
     * Display the banner.
     *
     * @param Banner $banner
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Move the banner to trash.
     *
     * @param Banner $banner
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Banner $banner)
    {
        $this->bannerRepository->deleteBanner($banner['id']);
        return redirect()->back()->with('success', 'Chuyển thành công banner vào thùng rác !');
    }

    /**
     * Display a listing of the trashed banner.
     *
     * @return View
     */
    public function trashed()
    {
        $banner = $this->bannerRepository->trashedBanner();
        return view('backend.banner.trashed')->with('banner', $banner);
    }

    /**
     * Restored a trashed news.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(Request $request, $id)
    {
        $banner = $this->bannerRepository->restoreBanner($id);
        $banner->restore();
        return redirect()->back()->with('success', 'Khôi phục thành công banner !');
    }

    /**
     * Force delete a trashed news.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function forceDelete($id)
    {
        $banner = $this->bannerRepository->onlyTrashedBanner($id);
        $banner->forceDelete();
        return redirect()->back()->with('success', 'Xóa thành công banner !');
    }
}


