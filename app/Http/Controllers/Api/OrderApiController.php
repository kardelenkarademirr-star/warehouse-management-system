<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Products;

class OrderApiController extends Controller
{
    public function store(Request $request) {

        $data = $request->validate([
            'customer' => 'required|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        $order = Orders::create([
            'customer' => $data['customer'],
            'status' => 'pending',
            'total' => 0
        ]);

        $grandTotal = 0;

    foreach ($data['items'] as $item) {
        $product = Products::find($item['product_id']);
        if ($product) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $product->price 
            ]);
            $grandTotal += ($product->price * $item['quantity']);
        }
    }

        $order->update(['total' => $grandTotal]);
        
        return response()->json(['message' => 'Sipariş depoya iletildi!', 'order_id' => $order->id, 'total' => $grandTotal], 201);
    }
}
