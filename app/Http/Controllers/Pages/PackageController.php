<?php

namespace App\Http\Controllers\Pages;

use App\Models\Orders;
use App\Models\Stock;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    public function index() {
        $packages = Orders::where('status', 'pending')->latest()->get();
        return view('packages', compact('packages'));
    }

    public function show($id) {
        $package = Orders::with('items.product')->findOrFail($id);
        return view('package', compact('package'));
    }

    public function pack($id) {
        $order = Orders::with('items.product')->findOrFail($id);
        
        foreach ($order->items as $item) {
            $stock = Stock::where('product_id', $item->product_id)->first();
            if ($stock) {
                $stock->decrement('quantity', $item->quantity);
            }
        }

        $order->update(['status' => 'packed']);
        return redirect()->route('packages')->with('success', 'Paketleme simülasyonu başarıyla tamamlandı!');
    }
}

