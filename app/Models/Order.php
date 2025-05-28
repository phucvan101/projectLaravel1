<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    //
    use SoftDeletes;
    use SearchableTrait;
    protected $guarded = [];
    public function orderDetails()
    {
        // quan hệ 1:n
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
