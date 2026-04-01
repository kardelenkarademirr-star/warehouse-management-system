<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders;
use App\Models\Package; 
use App\Models\Label;
use App\Models\Products;
use Illuminate\Support\Str;

class ProductController
{
    public function index()
    {
        $products = Products::latest()->get();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'price' => 'required|numeric'
        ]);

        Products::create($request->all());
        return redirect()->back()->with('success', 'Ürün başarıyla eklendi!');
    }
}
