<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::check()) abort(403, 'You are restricted to view this page.');
        $user = Auth::user();
        if ($user->role === User::ROLE_ADMIN) {
            return response()->json(Order::all());
        }
        return response()->json(Order::whereUserId($user->id)::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $this->authorize('create', Order::class);
        $validated = $request->validated();
        $order = Order::create($validated);
        return response()->json([
            'message' => 'Order was successfully created',
            'data' => $order
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $this->authorize('view', Order::class);
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $this->authorize('update', Order::class);
        $validated = $request->validated();
        $order->update($validated);
        return response()->json([
            'message' => 'Product category was successfully updated',
            'data' => $order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $this->authorize('delete', Order::class);
        $order->delete();
        return response()->json([
            'message' => 'Order was successfully deleted',
            'data' => $order
        ]);
    }
}
