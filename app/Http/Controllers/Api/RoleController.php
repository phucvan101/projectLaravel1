<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RoleAddRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Traits\HttpResponses;

class RoleController extends Controller
{
    //
    use HttpResponses;
    public function index()
    {
        $data = Role::all();

        if ($data->isEmpty()) {
            return $this->error([], 'No roles found', 404);
        }
        // in ra permission của user hiện tại
        $data = $data->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
                'description' => $role->description,
                'permissions' => $role->permissions->pluck('key_code')
            ];
        });
        return $this->success($data, 'List of roles');
    }

    public function store(RoleAddRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);

        // gan permission to user
        $role->permissions()->attach($request->permission_id);
        return $this->success($role, 'Role created successfully');
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        $infoRole = [
            'id' => $role->id,
            'name' => $role->name,
            'display_name' => $role->display_name,
            'permissions' => $role->permissions->pluck('key_code')
        ];
        return $this->success($infoRole, 'Role retrieved successfully');
    }

    public function update(RoleUpdateRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $roleUpdate = [];
        if ($request->has('name')) {
            $roleUpdate['name'] = $request->name;
        }
        if ($request->has('display_name')) {
            $roleUpdate['display_name'] = $request->display_name;
        }
        $role->update($roleUpdate); // cập nhật thông tin role

        // gan permission to user
        $role->permissions()->sync($request->permission_id); // xoa các permission cũ và thêm mới

        return $this->success($role, 'Role updated successfully');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        $data = Role::all();
        return $this->success($data, 'Role deleted successfully');
    }
}
