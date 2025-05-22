<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // sử dụng SoftDeletes để xóa mềm 
use App\Traits\SearchableTrait;


class Category extends Model
{
    //
    use SearchableTrait;
    use SoftDeletes; // sử dụng SoftDeletes để xóa mềm
    protected $fillable = ['name', 'parent_id', 'slug'];
}
