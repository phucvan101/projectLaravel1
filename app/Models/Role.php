<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
s
class Role extends Model
{
    //
    use SearchableTrait;
    use SoftDeletes;
    protected $guarded = [];
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }
}
