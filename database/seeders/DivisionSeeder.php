<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisions')->insert([
            'name' => 'admin',
        ]);
        
        DB::table('divisions')->insert([
            'name' => 'project_manager',
        ]);

        DB::table('divisions')->insert([
            'name' => 'programmer',
        ]);
    }
}
