<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserAddRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class UserAdminController extends Controller
{
    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        $users = $this->user->latest()->paginate(5);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    public function store(UserAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => request()->name,
                'email' => request()->email,
                'password' => Hash::make(request()->password)
            ]);
            $user->roles()->attach(request()->role_id);
            return redirect()->route('users.index');
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack(); // hủy tất cả nếu có lỗi 
            Log::error('Message: ' . $exception->getMessage() . '--- Line ' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $rolesOfUser = $user->roles;
        return view('admin.user.edit', compact(['roles', 'user', 'rolesOfUser']));
    }
}
