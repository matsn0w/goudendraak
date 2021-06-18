<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $userItem
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }
}
