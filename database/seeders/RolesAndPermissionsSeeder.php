<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 // Clear cache first
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    // Delete old data
   // Disable foreign key checks
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Permission::truncate();
        // Role::truncate();


        // Define permissions
    Permission::create(['name' => 'admin_create', 'guard_name' => 'admin']);
    Permission::create(['name' => 'admin_read', 'guard_name' => 'admin']);
    Permission::create(['name' => 'admin_update', 'guard_name' => 'admin']);
    Permission::create(['name' => 'admin_delete', 'guard_name' => 'admin']);

    Permission::create(['name' => 'assign_roles', 'guard_name' => 'admin']);

    Permission::create(['name' => 'user_create', 'guard_name' => 'admin']);
    Permission::create(['name' => 'user_read', 'guard_name' => 'admin']);
    Permission::create(['name' => 'user_update', 'guard_name' => 'admin']);
    Permission::create(['name' => 'user_delete', 'guard_name' => 'admin']);

    Permission::create(['name' => 'game_create', 'guard_name' => 'admin']);
    Permission::create(['name' => 'game_read', 'guard_name' => 'admin']);
    Permission::create(['name' => 'game_update', 'guard_name' => 'admin']);
    Permission::create(['name' => 'game_delete', 'guard_name' => 'admin']);

    Permission::create(['name' => 'result_create', 'guard_name' => 'admin']);
    Permission::create(['name' => 'result_read', 'guard_name' => 'admin']);
    Permission::create(['name' => 'result_update', 'guard_name' => 'admin']);
    Permission::create(['name' => 'result_rollback', 'guard_name' => 'admin']);

    Permission::create(['name' => 'wallet_create', 'guard_name' => 'admin']);
    Permission::create(['name' => 'wallet_read', 'guard_name' => 'admin']);
    Permission::create(['name' => 'wallet_update', 'guard_name' => 'admin']);
    Permission::create(['name' => 'wallet_delete', 'guard_name' => 'admin']);

      // Define roles
    $masterAdmin = Role::create(['name' => 'master_admin', 'guard_name' => 'admin']);
    $admin = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
    $executive = Role::create(['name' => 'executive', 'guard_name' => 'admin']);

        // Assign permissions to roles
    $masterAdmin->givePermissionTo(Permission::all());
    
    $admin->givePermissionTo(['user_create', 'user_read', 'user_update', 'game_read','wallet_read']);

    $executive->givePermissionTo(['user_read','result_read','result_create']);
    }
}
