<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'        => 1,
            'name'           => 'admin',
            'email'          => 'admin@timedoor.com',
            'password'       => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);
    }
}
