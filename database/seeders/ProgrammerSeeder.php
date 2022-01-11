<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProgrammerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'        => 3,
            'division_id'    => 3,
            'name'           => 'programmer',
            'email'          => 'programmer@timedoor.com',
            'password'       => Hash::make('programmer'),
            'remember_token' => Str::random(10),
        ]);
    }
}
