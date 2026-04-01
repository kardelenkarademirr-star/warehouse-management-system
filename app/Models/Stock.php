<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['product_id', 'warehouse_location_id', 'quantity'];
    
    public function product() {
        return $this->belongsTo(Products::class);
    }

    public function location() {
        return $this->belongsTo(WarehouseLocation::class, 'warehouse_location_id');
    }
}
