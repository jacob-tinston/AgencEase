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
        $permissions = [
            ['name' => 'manage organization'],
            ['name' => 'view users'],
            ['name' => 'manage users'],
            ['name' => 'view clients'],
            ['name' => 'manage clients'],
            ['name' => 'view chats'],
            ['name' => 'view tasks'],
            ['name' => 'view invoices'],
            ['name' => 'view notes'],
        ];
        $this->createPermissions($permissions);

        // Create Roles
        $roles = [
            ['name' => 'Super Admin'],
            ['name' => 'Admin'],
            ['name' => 'User'],
            ['name' => 'Contact'],
        ];
        $this->createRoles($roles);

        // Give Permissions to Roles

        $superAdmin = Role::findByName('Super Admin');
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::findByName('Admin');
        $admin->givePermissionTo(Permission::all()->where('name', '!=', 'manage organization'));

        $user = Role::findByName('User');
        $user->givePermissionTo(['view clients', 'view chats', 'view tasks', 'view notes']);

        $contact = Role::findByName('Contact');
        $contact->givePermissionTo(['view chats']);
    }

    protected function permissionExists($name) 
    {
        try {
            return Permission::findByName($name)->get();
        } catch(\Exception $err) {
            return false;
        }
    }

    protected function roleExists($name) 
    {
        try {
            return Role::findByName($name)->get();
        } catch(\Exception $err) {
            return false;
        }
    }

    protected function createPermissions($permissions)
    {
        foreach($permissions as $permission) {
            if (! $this->permissionExists($permission['name'])) {
                Permission::create($permission);
            }
        }
    }

    protected function createRoles($roles)
    {
        foreach($roles as $role) {
            if (! $this->roleExists($role['name'])) {
                Role::create($role);
            }
        }
    }
}
