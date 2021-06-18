<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Barryvdh\DomPDF\Facade as PDF;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\MenuItem $menuItem
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $item = MenuItem::findOrFail($id);

        return view('admin.menu.edit', [
            'ítem' => $item,
        ]);
    }

    public function download()
    {
        // get all menu items
        $items = MenuItem::all();
        $categories = MenuCategory::all();

        // generate a PDF file
        $pdf = PDF::loadView('pdf.menu', [
            'items' => $items,
            'categories' => $categories,
        ]);

        return $pdf->download('gouden_draak_menu.pdf');
    }
}
