<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['order_id', 'package_code'];

    public function label()
    {
        return $this->hasOne(Label::class);
    }
}
