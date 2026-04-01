<?php

namespace App\Http\Controllers\Pages;

use App\Models\Orders;
use App\Models\Stock;
use Illuminate\Http\Request;

class OrderController
{
    public function index()
    {
        $orders = Orders::latest()->get();
        return view('orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Orders::with('items.product')->findOrFail($id);
        return view('orders.show', compact(order));
    }

    public function pack($id)
    {
        $order = Orders::with('items')->findOrFail($id);
        foreach ($order->items as $item) {
            $stock = Stock::where('product_id', $item->product_id)->where('quantity', '>=', $item->quantity)->first();
            
            if (!$stock) {
                return redirect()->back()->with('error', 'Yetersiz stok: ' . ($item->product->name ?? 'ürün'));
            }

            $stock->decrement('quantity', $item->quantity);
        }

        $order->update(['status' => 'packed']);
        return redirect()->back()->with('success', 'Sipariş paketlendi ve stok güncellendi!');
    }
}
