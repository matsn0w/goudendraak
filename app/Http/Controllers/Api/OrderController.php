<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Order::with('items');

        if ($request->filled('startdate')) {
            try {
                $startdate = Carbon::parse($request->input('startdate'));
            } catch (Exception $e) {
                abort(400, __('messages.invalid_start_date'));
            }

            $query->date($startdate);
        }

        if ($request->filled('enddate')) {
            try {
                $enddate = Carbon::parse($request->input('enddate'));
            } catch (Exception $e) {
                abort(400, __('messages.invalid_end_date'));
            }

            $query->date(null, $enddate);
        }

        return OrderResource::collection($query->get());
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
        $order = Order::create([
            'table' => $validated['table'],
        ]);

        // attach items
        foreach ($items as $item) {
            $order->items()->attach($item['id'], [
                'amount' => $item['amount'],
                'notes' => $item['notes'] ?? null,
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
