<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuItemRequest;
use App\Http\Resources\MenuItemResource;
use App\Models\MenuItem;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MenuItemResource::collection(MenuItem::with('category')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MenuItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuItemRequest $request)
    {
        // validate the request
        $validated = $request->validated();

        // create the new item
        $item = MenuItem::create($validated);

        return new MenuItemResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new MenuItemResource(MenuItem::with('category')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MenuItemRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuItemRequest $request, $id)
    {
        // validate the request
        $validated = $request->validated();

        // find the item
        $item = MenuItem::findOrFail($id);

        // update the item
        $item->update($validated);

        return new MenuItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find the item
        $item = MenuItem::findOrFail($id);

        // delete the item
        $item->delete();

        return response()->json(null, 204);
    }
}
