<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = ['package_id', 'barcode'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
