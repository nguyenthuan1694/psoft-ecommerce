<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Models\Image;
use App\Models\News;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Repositories\News\NewsRepository;

class NewsController extends Controller
{
    /**
     * @var NewsRepositoryInterface|\App\Repositories\Repository
    */
    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }


    /**
     * Display a listing of products.
     *
     * @return View
     */
    public function index()
    {
        $news = $this->newsRepository->getAll();
        return view('backend.news.index')->with('news', $news);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return View
     */
    public function create()
    {
        return view('backend.news.create');
    }

    /**
     * Store a new product.
     *
     * @param NewsStoreRequest $request
     * @return RedirectResponse
     */
    public function store(NewsStoreRequest $request)
    {
        $news = $this->newsRepository->create($request->except(['thumbnail']));
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnailName = generateProductImageName(1,$file->getClientOriginalExtension());
            $thumbnailPath = generateProductImagePath(1);
            $file->storeAs($thumbnailPath, $thumbnailName);
            // $news->thumbnail = Storage::url($thumbnailPath . '/' .$thumbnailName);
            $news->thumbnail = $thumbnailPath . '/' .$thumbnailName;
            $news->save();
        }
        return redirect()->route('news.index')->with('success', 'Thêm tin tức thành công !');
    }

    /**
     * Show the form for editing the news.
     *
     * @param News $news
     * @return View
     */
    public function edit(News $news)
    {
        return view('backend.news.edit')
            ->with('news', $news);
    }

    /**
     * Update the news.
     *
     * @param NewsUpdateRequest $request
     * @param News $news
     * @return RedirectResponse
     */
    public function update(NewsUpdateRequest $request, News $news)
    {
        $this->newsRepository->update($request->id, $request->except(['thumbnail']));
        if ($request->hasFile('thumbnail')) {
            if (file_exists(public_path() . $news->thumbnail)) {
                unlink(public_path() . $news->thumbnail);
            }
            $file = $request->thumbnail;
            $thumbnailName = generateProductImageName($news->id,$file->getClientOriginalExtension());
            $thumbnailPath = generateProductImagePath($news->id);
            $file->storeAs($thumbnailPath, $thumbnailName);
            $news->thumbnail = $thumbnailPath . '/' .$thumbnailName;
            $news->save();
        }
        return redirect()->route('news.index')->with('success', 'You have successfully updated the news');
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
     * @param News $news
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(News $news)
    {
        $this->newsRepository->deleteNews($news['id']);
        return redirect()->back()->with('success', 'You have successfully move the news to trashed');
    }

    /**
     * Display a listing of the trashed news.
     *
     * @return View
     */
    public function trashed()
    {
        $news = $this->newsRepository->trashedNews();
        return view('backend.news.trashed')->with('news', $news);
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
        $news = $this->newsRepository->restoreNews($id);
        $news->restore();
        return redirect()->back()->with('success', 'You have successfully restored the news');
    }

    /**
     * Force delete a trashed news.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function forceDelete($id)
    {
        $news = $this->newsRepository->onlyTrashedNews($id);
        $news->forceDelete();
        return redirect()->back()->with('success', 'You have successfully deleted the news');
    }
}


