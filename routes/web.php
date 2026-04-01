<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\WarehouseController;
use App\Http\Controllers\Pages\ProductController;
use App\Http\Controllers\Pages\StockController;
use App\Http\Controllers\Pages\PackageController;
use App\Http\Controllers\Pages\DashboardController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/orders', [WarehouseController::class, 'index'])->name('orders');
Route::get('/order-detail/{id}', [WarehouseController::class, 'show'])->name('order.show');
Route::post('/order-pack/{id}', [WarehouseController::class, 'pack'])->name('order.pack');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/stocks', [StockController::class, 'index'])->name('stocks');
Route::post('/stocks/update/{id}', [StockController::class, 'update'])->name('stocks.update');
Route::post('/stocks/store', [StockController::class, 'store'])->name('stocks.store');
Route::get('/packages', [PackageController::class, 'index'])->name('packages');
Route::get('/package-detail/{id}', [PackageController::class, 'show'])->name('package.show');
Route::post('/package-pack/{id}', [PackageController::class, 'pack'])->name('package.pack');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');