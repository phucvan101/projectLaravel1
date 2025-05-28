<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchableTrait;

class Order extends Model
{
    //
    use SearchableTrait;
    protected $guarded = [];
    public function orderDetails()
    {
        // quan hệ 1:n
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
