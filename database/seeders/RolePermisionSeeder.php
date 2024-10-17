<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Data permission dengan kategori
        $permissions = [
            ['name' => 'useradmin', 'category' => 'master-admin'],
            ['name' => 'fitur', 'category' => 'master-admin'],
            ['name' => 'client', 'category' => 'lainnya'],
            ['name' => 'monitoring', 'category' => 'lainnya'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

          $roles = [
            'admin' => ['useradmin', 'fitur', 'client', 'monitoring'],
            'editor' => ['client'],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo($rolePermissions);
        }
    }
        
    }

