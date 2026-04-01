<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Package; 
use App\Models\Label;
use Illuminate\Support\Str; //rastgele barkod üretmek için

class WarehouseController
{
    public function index()
    {
        $orders = Orders::all();
        return view('orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Orders::with('items')->findOrFail($id);
        return view('order', compact('order'));
    }

    public function pack($id)
    {
        $order = Orders::findOrFail($id);

        $package = Package::create([
            'order_id'     => $order->id,
            'package_code' => 'PK-' . strtoupper(Str::random(10)),
            'status'=> 'packaged'
        ]);

        Label::create([
            'package_id' => $package->id,
            'barcode' => 'BAR-' . rand(100000, 999999)
        ]);

        $order->update(['status' => 'completed']);
        return redirect()->back()->with('success', 'Sipariş paketlendi ve etiket hazır!');
    }

    public function packages()
    {
        $packages = Package::with('label')->orderBy('created_at', 'desc')->get();
        return view('packages', compact('packages'));
    }
}
