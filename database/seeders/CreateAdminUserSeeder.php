<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1) Create / Get Role (مايتكررش)
        |--------------------------------------------------------------------------
        */
        $role = Role::firstOrCreate(['name' => 'owner']);

        /*
        |--------------------------------------------------------------------------
        | 2) Give role all permissions
        |--------------------------------------------------------------------------
        */
        $permissions = Permission::pluck('name')->toArray();
        $role->syncPermissions($permissions);

        /*
        |--------------------------------------------------------------------------
        | 3) Create admin user (مايتكررش)
        |--------------------------------------------------------------------------
        */
        $user = User::firstOrCreate(
            ['email' => 'abdallahwael352@gmail.com'],
            [
                'name' => 'Abdallah',
                'password' => Hash::make('12345678'),
                'Status' => 'مفعل',
                'roles_name' => ['owner'],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 4) Assign role correctly
        |--------------------------------------------------------------------------
        */
        $user->syncRoles([$role->name]);
    }
}
