<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionAdminController extends Controller
{
    //
    public function createPermission()
    {
        return view('admin.permission.add');
    }

    public function store()
    {
        $permission = Permission::create([
            'name' => request()->module_parent,
            'display_name' => request()->module_parent,
            'parent_id' => 0,
            'key_code' => '',
        ]);
        foreach (request()->module_children as $value) {
            Permission::create([
                'name' => $value,
                'display_name' => $value,
                'parent_id' => $permission->id,
                'key_code' => request()->module_parent . '_' . $value
            ]);
        }
        return redirect()->route('permissions.create');
    }
}
