<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = ['customer','status','total'];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function package()
    {
        return $this->hasOne(Package::class);
    }

    public function getTotalAmountAttribute()
    {
        return $this->items->sum(function($item) {
        return $item->price * $item->quantity;
        });
    }
}
