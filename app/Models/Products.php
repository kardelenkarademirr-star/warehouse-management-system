<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ['name', 'sku', 'price'];

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
