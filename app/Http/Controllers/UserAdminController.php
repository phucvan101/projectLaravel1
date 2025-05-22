<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserAddRequest;
use App\Traits\DeleteModelTrait;
use Exception;
use Illuminate\Support\Facades\Log;

class UserAdminController extends Controller
{
    use DeleteModelTrait;
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
            $user->roles()->attach(request()->role_id); // attach dùng để thêm một hoặc nhiều bản ghi vào bảng trung gian của quan hệ n:n
            DB::commit();
            return redirect()->route('users.index');
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

    public function update($id)
    {
        try {
            DB::beginTransaction();
            $dataUpdate = [
                'name' => request()->name,
                'email' => request()->email,
            ];
            if (request()->filled('password')) {
                $dataUpdate['password'] = Hash::make(request()->password);
            }
            $this->user->find($id)->update($dataUpdate);
            $user = $this->user->find($id);
            $user->roles()->sync(request()->role_id); // sync dùng để đồng bộ các bản ghi trong bảng trung gian của quan hệ n:n
            DB::commit();
            return redirect()->route('users.index');
        } catch (Exception $exception) {
            DB::rollBack(); // hủy tất cả nếu có lỗi 
            Log::error('Message: ' . $exception->getMessage() . '--- Line ' . $exception->getLine());
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->user);
    }

    public function search()
    {
        $query = request()->input('query');
        $users = User::search('name', $query)->paginate(5);
        return view('admin.user.search', compact('users'));
    }
}
