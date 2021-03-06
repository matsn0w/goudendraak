<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsItemRequest;
use App\Http\Resources\NewsItemResource;
use App\Models\NewsItem;

class NewsItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return NewsItemResource::collection(NewsItem::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(NewsItemRequest $request)
    {
        // validate the request
        $validated = $request->validated();

        // create the new item
        $item = NewsItem::create($validated);

        return new NewsItemResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new NewsItemResource(NewsItem::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(NewsItemRequest $request, int $id)
    {
        // validate the request
        $validated = $request->validated();

        // find the item
        $item = NewsItem::findOrFail($id);

        // update the item
        $item->update($validated);

        return new NewsItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        // find the item
        $item = NewsItem::findOrFail($id);

        // delete the item
        $item->delete();

        return response()->json(null, 204);
    }
}
