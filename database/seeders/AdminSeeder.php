<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin =[
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('itsmytime@1198')
        ];
        Admin::create($admin);
    }
}
