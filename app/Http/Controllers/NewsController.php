<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewsItem  $newsItem
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $item = NewsItem::findOrFail($id);

        return view('admin.news.edit', [
            'ítem' => $item
        ]);
    }
}
