<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
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
     * @param  \App\Models\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $item = MenuItem::findOrFail($id);

        return view('admin.menu.edit', [
            'ítem' => $item
        ]);
    }
}
