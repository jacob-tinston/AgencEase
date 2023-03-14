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

        // Create Permissions
        Permission::create(['name' => 'manage organization']);
        Permission::create(['name' => 'manage users']);
        
        // Create Roles
        $superAdmin = Role::create(['name' => 'Super Admin']);

        // Give Permissions to Roles
        $superAdmin->givePermissionTo(Permission::all());
    }
}
