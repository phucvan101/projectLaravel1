<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Tạo user admin (nếu chưa có)
        $admin = DB::table('users')->where('email', 'admin@example.com')->first();
        if (!$admin) {
            $adminId = DB::table('users')->insertGetId([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('123456'), // Mật khẩu mặc định
            ]);
        } else {
            $adminId = $admin->id;
        }

        // 2. Tạo role 'admin' nếu chưa có
        $role = DB::table('roles')->where('name', 'admin')->first();
        if (!$role) {
            $roleId = DB::table('roles')->insertGetId([
                'name' => 'admin',
                'display_name' => 'System Administration',
            ]);
        } else {
            $roleId = $role->id;
        }

        // 3. Gán role admin cho user (nếu chưa gán)
        $hasRole = DB::table('role_user')
            ->where('user_id', $adminId)
            ->where('role_id', $roleId)
            ->exists();
        if (!$hasRole) {
            DB::table('role_user')->insert([
                'user_id' => $adminId,
                'role_id' => $roleId,
            ]);
        }

        // 4. Gán tất cả quyền có sẵn cho role admin
        $permissionIds = DB::table('permissions')->pluck('id')->toArray();

        foreach ($permissionIds as $permissionId) {
            $exists = DB::table('permission_role')
                ->where('role_id', $roleId)
                ->where('permission_id', $permissionId)
                ->exists();

            if (!$exists) {
                DB::table('permission_role')->insert([
                    'role_id' => $roleId,
                    'permission_id' => $permissionId,
                ]);
            }
        }
    }
}
