<?php

namespace App\Http\Controllers;

use App\Traits\DeleteModelTrait;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleAdminController extends Controller
{
    //
    use DeleteModelTrait;
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $roles = $this->role->paginate();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add', compact('permissions'));
    }

    public function store()
    {
        $role = $this->role->create([
            'name' => request()->name,
            'display_name' => request()->display_name,
        ]);
        $role->permissions()->attach(request()->permission_id);
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $permissionsParent = $this->permission->where('parent_id', 0)->get();
        $role = $this->role->find($id);
        $permissionChecked = $role->permissions;
        return view('admin.role.edit', compact(['permissionsParent', 'role', 'permissionChecked']));
    }

    public function update($id)
    {
        $role = $this->role->find($id);
        $role->update([
            'name' => request()->name,
            'display_name' => request()->display_name,
        ]);
        $role->permissions()->sync(request()->permission_id);
        return redirect()->route('roles.index');
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->role);
    }

    public function search()
    {
        $query = request()->input('query');
        $roles = Role::search('name', $query)->paginate(5);
        return view('admin.role.search', compact(['query', 'roles']));
    }
}
