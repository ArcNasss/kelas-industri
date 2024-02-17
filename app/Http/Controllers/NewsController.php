<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Http\Requests\NewsRequest;

class NewsController extends Controller
{
    private NewsService $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newss = $this->newsService->handleGetPaginate();
        return view('dashboard.admin.pages.news.index', compact('newss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.pages.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $this->newsService->handleCreate($request);
        return to_route('admin.news.index')->with('success', trans('alert.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('dashboard.admin.pages.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {
        // dd($news->all());
        $this->newsService->handleUpdate($request, $news);
        return to_route('admin.news.index')->with('success', trans('alert.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $data = $this->newsService->handleDelete($news);

        if (!$data) {
            return back()->with('error', trans('alert.delete_constrained'));
        }

        return back()->with('success', trans('alert.delete_success'));
    }

    /**
 * Update the status of the specified news item.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\News  $news
 * @return \Illuminate\Http\Response
 */
public function updateStatus(Request $request, News $news)
{
    $validatedData = $request->validate([
        'status' => 'required|in:On,Off',
    ]);

    $status = $validatedData['status'];

    if ($status === 'On') {
        // Turn off other News items since only one can be 'On'
        News::where('status', 'On')->update(['status' => 'Off']);
    }

    $news->update(['status' => $status]);

    return back()->with('success', trans('alert.update_success'));
}
}
