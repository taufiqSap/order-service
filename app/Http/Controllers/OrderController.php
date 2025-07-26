<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModel;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(OrderModel::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'required|string|max:20',
            'address'      => 'required|string',
            'rental_days'  => 'required|integer|min:1',
            'total_price'  => 'required|integer|min:0',
            'status'       => 'nullable|in:pending,approved,rejected', // nullable karena bisa default di DB
        ]);

        // Pastikan status default jika tidak dikirim
        if (!isset($validatedData['status'])) {
            $validatedData['status'] = 'pending';
        }

        $order = OrderModel::create($validatedData);

        return response()->json([
            'message' => 'Order created successfully',
            'order'   => $order,
        ], 201);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'status'       => 'nullable|in:pending,approved,rejected',
        ]);
        $order = OrderModel::findOrFail($request->id);
        $order->update($validatedData);
    }


    public function show($id)
    {
        $order = OrderModel::findOrFail($id);
        return response()->json($order);
    }


   /* public function destroy($id)
    {
        $order = OrderModel::findOrFail($id);
        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully',
        ], 200);
    }
        */
}