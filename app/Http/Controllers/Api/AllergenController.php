<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AllergenRequest;
use App\Http\Resources\AllergenResource;
use App\Models\Allergen;

class AllergenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AllergenResource::collection(Allergen::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AllergenRequest $request)
    {
        // validate the request
        $validated = $request->validated();

        // create the new item
        $item = Allergen::create($validated);

        return new AllergenResource($item);
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
        return new AllergenResource(Allergen::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AllergenRequest $request, $id)
    {
        // validate the request
        $validated = $request->validated();

        // find the item
        $item = Allergen::findOrFail($id);

        // update the item
        $item->update($validated);

        return new AllergenResource($item);
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
        // find the item
        $item = Allergen::findOrFail($id);

        // delete the item
        $item->delete();

        return response()->json(null, 204);
    }
}
