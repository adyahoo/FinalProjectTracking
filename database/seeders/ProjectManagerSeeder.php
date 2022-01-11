<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProjectManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'        => 2,
            'division_id'    => 2,
            'name'           => 'project manager',
            'email'          => 'pm@timedoor.com',
            'password'       => Hash::make('projectmanager'),
            'remember_token' => Str::random(10),
        ]);
    }
}
