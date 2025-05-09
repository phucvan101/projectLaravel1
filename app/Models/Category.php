<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // sử dụng SoftDeletes để xóa mềm 

class Category extends Model
{
    //
    use SoftDeletes; // sử dụng SoftDeletes để xóa mềm
    protected $fillable = ['name', 'parent_id', 'slug'];
}
