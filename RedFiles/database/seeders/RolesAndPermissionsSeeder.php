<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'edit documents']);
        Permission::create(['name' => 'delete documents']);
        Permission::create(['name' => 'create documents']);
        Permission::create(['name' => 'view documents']);

        // Create roles and assign created permissions

        // Admin role gets all permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // User role gets specific permissions
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo(['view documents', 'create documents']);
    }
}
