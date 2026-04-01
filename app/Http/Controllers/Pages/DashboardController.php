<?php

namespace App\Http\Controllers\Pages;

use App\Models\Orders;
use App\Models\Products;

class DashboardController
{
    public function index() {
        $totalEarnings = Orders::where('status', 'packed')->sum('total');
        $pendingOrders = Orders::where('status', 'pending')->count();
        $packedOrders = ORders::where('status', 'packed')->count();

        $recentOrders = Orders::orderBy('created_at', 'desc')->take(10)->get();

        return view('dashboard', compact(
            'totalEarnings',
            'pendingOrders',
            'packedOrders',
            'recentOrders'
        ));
    }
}
