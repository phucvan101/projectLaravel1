<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchableTrait;

class Setting extends Model
{
    //
    use SearchableTrait;
    protected $guarded = [];
}
