<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
