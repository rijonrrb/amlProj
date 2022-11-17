<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           
        \App\Models\Admin::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin2022@amlbd.com',
            'password' => md5('Abc@123'),
            'admin_type' => 'SAdmin',          
        ]);

    }
}
