<?php

namespace App\Http\Controllers;

class CashierController extends Controller
{
    public function index()
    {
        return view('cashier.index');
    }

    public function dishes()
    {
        return view('cashier.dishes');
    }

    public function overview()
    {
        return view('cashier.overview');
    }
}
