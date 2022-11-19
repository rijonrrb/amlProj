<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('admins')->insert([
            'name' => 'Super Admin',
            'email' => 'abc',
            'password' => md5('abc'),
            'admin_type' => 'SAdmin',
            'create' => 'True',  
            'update' => 'True',  
            'delete' => 'True',            
            'issue' => 'True',  
            'return' => 'True',   
        ]);

    }
}
