<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Define permissions
        $createTaskPermission = Permission::firstOrCreate(['name' => 'create task']);
        $deleteTaskPermission = Permission::firstOrCreate(['name' => 'delete task']);
        $editTaskPermission = Permission::firstOrCreate(['name' => 'edit task']);
        $viewTaskPermission = Permission::firstOrCreate(['name' => 'view task']);

        // Assign permissions to roles
        $adminRole->givePermissionTo($createTaskPermission);
        $adminRole->givePermissionTo($deleteTaskPermission);
        $adminRole->givePermissionTo($editTaskPermission);
        $adminRole->givePermissionTo($viewTaskPermission);
        $userRole->givePermissionTo($createTaskPermission);

        //// If you need to delete permission or role, just uncomment and add required name 

        // Delete a permission 
        // app(PermissionRegistrar::class)->forgetCachedPermissions();
        // Permission::where('name', 'view task')->delete();

        // Delete a role
        // app(PermissionRegistrar::class)->forgetCachedPermissions();
        // Role::where('name', 'admin')->delete();
    }
}
