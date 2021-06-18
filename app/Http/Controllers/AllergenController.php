<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Barryvdh\DomPDF\Facade as PDF;

class AllergenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.menu.allergens.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.allergens.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $allergen = Allergen::findOrFail($id);

        return view('admin.menu.allergens.edit', [
            'allergen' => $allergen
        ]);
    }
}
