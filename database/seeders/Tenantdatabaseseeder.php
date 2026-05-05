<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class Tenantdatabaseseeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ----------------------------
        // 1. Create Permissions
        // ----------------------------
        $permissions = [
            'view users',
            'edit users',
            'delete users',
            'create articles',
            'edit articles',
            'delete articles',
            'view articles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // ----------------------------
        // 2. Create Roles & Assign Permissions
        // ----------------------------

        // Superadmin — all permissions
        $superadmin = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);
        $superadmin->syncPermissions(Permission::all());

        // Admin — all permissions
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());

        // Publisher — can create, edit, view articles
        $publisher = Role::firstOrCreate(['name' => 'publisher', 'guard_name' => 'web']);
        $publisher->syncPermissions([
            'create articles',
            'edit articles',
            'view articles',
        ]);

        // Editor — can edit and view articles
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $editor->syncPermissions([
            'edit articles',
            'view articles',
        ]);

        // Viewer — can only view articles
        $viewer = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);
        $viewer->syncPermissions([
            'view articles',
        ]);

        // ----------------------------
        // 3. Create Default Admin User
        // ----------------------------
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@tenant.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
                'phone'    => '00000000',
                'age'      => 25,
            ]
        );

        $adminUser->assignRole('superadmin');
    }
}