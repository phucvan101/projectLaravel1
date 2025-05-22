<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchableTrait;


class Menu extends Model
{
    //
    use SoftDeletes;
    use SearchableTrait;
    protected $fillable = [
        'name',
        'parent_id',
        'slug',
    ];
}
