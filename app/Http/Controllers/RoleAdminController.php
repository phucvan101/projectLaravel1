<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleAdminController extends Controller
{
    //
    private $role;
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        $roles = $this->role->paginate();
        return view('admin.role.index', compact('roles'));
    }
}
