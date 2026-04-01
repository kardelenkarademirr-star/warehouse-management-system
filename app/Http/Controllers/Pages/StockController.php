<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders;
use App\Models\Package; 
use App\Models\Label;
use App\Models\Products;
use App\Models\Stock;
use Illuminate\Support\Str;

class StockController
{
    public function index() {
        $stocks = Stock::with(['product', 'location'])->get();

        $products = \App\Models\Products::all();

        $locations = \App\Models\WarehouseLocation::all();

        return view('stocks.index', compact('stocks', 'products', 'locations'));
    }
    

    public function store(Request $request) {
        $request->validate([
            'product_id' => 'required',
            'warehouse_location_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $stock = Stock::updateOrCreate(
            [
                'product_id' => $request->product_id,
                'warehouse_location_id' => $request->warehouse_location_id
            ],
            [
                'quantity' => \DB::raw('quantity +' . $request->quantity)
            ]
        );

        return redirect()->back()->with('success', 'Stok güncellendi!');
    }
}
