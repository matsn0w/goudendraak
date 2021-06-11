<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderResource::collection(Order::with('items')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        // validate the request
        $validated = $request->validated();

        // get the selected items
        $items = $validated['items'];

        // create the new order
        $order = Order::create();

        // attach items
        foreach ($items as $item) {
            $order->items()->attach($item['id'], [
                'amount' => $item['amount']
            ]);
        }

        return new OrderResource(Order::with('items')->findOrFail($order->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new OrderResource(Order::with('items')->findOrFail($id));
    }
}
