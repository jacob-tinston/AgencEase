<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

        // Create Permissions
        Permission::create(['name' => 'manage organization']);

        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'manage users']);

        Permission::create(['name' => 'view clients']);
        Permission::create(['name' => 'manage clients']);

        // Create Roles
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $user = Role::create(['name' => 'User']);
        $client = Role::create(['name' => 'Client']);

        // Give Permissions to Roles
        $superAdmin->givePermissionTo(Permission::all());
        $admin->givePermissionTo(Permission::all()->where('name', '!=', 'manage organization'));
        $user->givePermissionTo(['view clients']);
    }
}
