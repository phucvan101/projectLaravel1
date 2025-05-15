<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'admin', 'display_name' => 'system administration'],
            ['name' => 'guest', 'display_name' => 'customer'],
            ['name' => 'develop', 'display_name' => 'developer'],
            ['name' => 'content', 'display_name' => 'manager content '],
        ]);
    }
}
