<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'      => 'Admin',
            'privilege' => 'admin'
        ]);

        DB::table('roles')->insert([
            'name'      => 'Project Manager',
            'privilege' => 'project_manager'
        ]);

        DB::table('roles')->insert([
            'name'      => 'Programmer',
            'privilege' => 'employee'
        ]);
    }
}
