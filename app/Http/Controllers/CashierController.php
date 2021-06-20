<?php

namespace App\Http\Controllers;

class CashierController extends Controller
{
    public function index()
    {
        return view('cashier.index');
    }

    public function payment()
    {
        return view('cashier.payment');
    }

    public function dishes()
    {
        return view('cashier.dishes');
    }

    public function overview()
    {
        return view('cashier.overview');
    }

    public function orders()
    {
        return view('cashier.orders');
    }
}
