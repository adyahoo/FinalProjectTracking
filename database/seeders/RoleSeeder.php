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
            'name'      => 'admin',
            'previlege' => 'admin'
        ]);

        DB::table('roles')->insert([
            'name'      => 'project_manager',
            'previlege' => 'project_manager'
        ]);

        DB::table('roles')->insert([
            'name'      => 'programmer',
            'previlege' => 'employee'
        ]);
    }
}
