<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuCategoryRequest;
use App\Http\Resources\MenuCategoryResource;
use App\Models\MenuCategory;

class MenuCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MenuCategoryResource::collection(MenuCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MenuCategoryRequest $request)
    {
        // validate the request
        $validated = $request->validated();

        // create the new category
        $category = MenuCategory::create($validated);

        return new MenuCategoryResource($category);
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
        return new MenuCategoryResource(MenuCategory::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(MenuCategoryRequest $request, $id)
    {
        // validate the request
        $validated = $request->validated();

        // find the category
        $category = MenuCategory::findOrFail($id);

        // update the category
        $category->update($validated);

        return new MenuCategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find the category
        $category = MenuCategory::findOrFail($id);

        // delete the category
        $category->delete();

        return response()->json(null, 204);
    }
}
