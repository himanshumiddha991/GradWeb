<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create or get the Master Admin role
        $masterAdminRole = Role::firstOrCreate(
            ['name' => 'master_admin', 'guard_name' => 'admin']
        );

        // Create the Admin user if it doesn’t exist
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin'),
            ]
        );

        // Assign the master_admin role to this user
        if (!$admin->hasRole('master_admin')) {
            $admin->assignRole($masterAdminRole);
        }

        $this->command->info('Master Admin created with role: master_admin');
    }
}
