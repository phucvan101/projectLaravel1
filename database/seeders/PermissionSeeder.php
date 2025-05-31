<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $permissions = [
            // Category
            ['name' => 'category', 'display_name' => 'category', 'parent_id' => 0],
            ['name' => 'list', 'display_name' => 'list', 'parent_id' => 1, 'key_code' => 'category_list'],
            ['name' => 'add', 'display_name' => 'add', 'parent_id' => 1, 'key_code' => 'category_add'],
            ['name' => 'edit', 'display_name' => 'edit', 'parent_id' => 1, 'key_code' => 'category_edit'],
            ['name' => 'delete', 'display_name' => 'delete', 'parent_id' => 1, 'key_code' => 'category_delete'],

            // Slider
            ['name' => 'slider', 'display_name' => 'slider', 'parent_id' => 0],
            ['name' => 'list', 'display_name' => 'list', 'parent_id' => 6, 'key_code' => 'slider_list'],
            ['name' => 'add', 'display_name' => 'add', 'parent_id' => 6, 'key_code' => 'slider_add'],
            ['name' => 'edit', 'display_name' => 'edit', 'parent_id' => 6, 'key_code' => 'slider_edit'],
            ['name' => 'delete', 'display_name' => 'delete', 'parent_id' => 6, 'key_code' => 'slider_delete'],

            // Product
            ['name' => 'product', 'display_name' => 'product', 'parent_id' => 0],
            ['name' => 'list', 'display_name' => 'list', 'parent_id' => 11, 'key_code' => 'product_list'],
            ['name' => 'add', 'display_name' => 'add', 'parent_id' => 11, 'key_code' => 'product_add'],
            ['name' => 'edit', 'display_name' => 'edit', 'parent_id' => 11, 'key_code' => 'product_edit'],
            ['name' => 'delete', 'display_name' => 'delete', 'parent_id' => 11, 'key_code' => 'product_delete'],

            // Setting
            ['name' => 'setting', 'display_name' => 'setting', 'parent_id' => 0],
            ['name' => 'list', 'display_name' => 'list', 'parent_id' => 16, 'key_code' => 'setting_list'],
            ['name' => 'add', 'display_name' => 'add', 'parent_id' => 16, 'key_code' => 'setting_add'],
            ['name' => 'edit', 'display_name' => 'edit', 'parent_id' => 16, 'key_code' => 'setting_edit'],
            ['name' => 'delete', 'display_name' => 'delete', 'parent_id' => 16, 'key_code' => 'setting_delete'],

            // User
            ['name' => 'user', 'display_name' => 'user', 'parent_id' => 0],
            ['name' => 'list', 'display_name' => 'list', 'parent_id' => 21, 'key_code' => 'user_list'],
            ['name' => 'add', 'display_name' => 'add', 'parent_id' => 21, 'key_code' => 'user_add'],
            ['name' => 'edit', 'display_name' => 'edit', 'parent_id' => 21, 'key_code' => 'user_edit'],
            ['name' => 'delete', 'display_name' => 'delete', 'parent_id' => 21, 'key_code' => 'user_delete'],

            // Role
            ['name' => 'role', 'display_name' => 'role', 'parent_id' => 0],
            ['name' => 'list', 'display_name' => 'list', 'parent_id' => 26, 'key_code' => 'role_list'],
            ['name' => 'add', 'display_name' => 'add', 'parent_id' => 26, 'key_code' => 'role_add'],
            ['name' => 'edit', 'display_name' => 'edit', 'parent_id' => 26, 'key_code' => 'role_edit'],
            ['name' => 'delete', 'display_name' => 'delete', 'parent_id' => 26, 'key_code' => 'role_delete'],

            // Menu
            ['name' => 'menu', 'display_name' => 'menu', 'parent_id' => 0],
            ['name' => 'list', 'display_name' => 'list', 'parent_id' => 31, 'key_code' => 'menu_list'],
            ['name' => 'add', 'display_name' => 'add', 'parent_id' => 31, 'key_code' => 'menu_add'],
            ['name' => 'edit', 'display_name' => 'edit', 'parent_id' => 31, 'key_code' => 'menu_edit'],
            ['name' => 'delete', 'display_name' => 'delete', 'parent_id' => 31, 'key_code' => 'menu_delete'],

            // Order
            ['name' => 'order', 'display_name' => 'order', 'parent_id' => 0],
            ['name' => 'list', 'display_name' => 'list', 'parent_id' => 36, 'key_code' => 'order_list'],
            ['name' => 'edit', 'display_name' => 'edit', 'parent_id' => 36, 'key_code' => 'order_edit'],
            ['name' => 'delete', 'display_name' => 'delete', 'parent_id' => 36, 'key_code' => 'order_delete'],

            // Test
            ['name' => 'test', 'display_name' => 'test', 'parent_id' => 0],
            ['name' => 'list', 'display_name' => 'list', 'parent_id' => 45, 'key_code' => 'test_list'],
            ['name' => 'add', 'display_name' => 'add', 'parent_id' => 45, 'key_code' => 'test_add'],
            ['name' => 'edit', 'display_name' => 'edit', 'parent_id' => 45, 'key_code' => 'test_edit'],
            ['name' => 'delete', 'display_name' => 'delete', 'parent_id' => 45, 'key_code' => 'test_delete'],
        ];

        foreach ($permissions as $index => $permission) {
            DB::table('permissions')->insert([
                'name' => $permission['name'],
                'display_name' => $permission['display_name'],
                'parent_id' => $permission['parent_id'],
                'key_code' => $permission['key_code'] ?? null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
