<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $allWrite = array_fill_keys(Role::modules(), 'write');

        Role::firstOrCreate(
            ['slug' => 'super-admin'],
            [
                'name' => 'Super Administrator',
                'description' => 'Full system read/write access to all resources',
                'permissions' => $allWrite,
                'is_super_admin' => true,
            ]
        );

        Role::firstOrCreate(
            ['slug' => 'insurance-advisor'],
            [
                'name' => 'Insurance Advisor',
                'description' => 'Can manage assigned clients, leads, and policies',
                'permissions' => [
                    'dashboard' => 'read',
                    'clients' => 'write',
                    'policies' => 'write',
                    'leads' => 'write',
                    'tasks' => 'write',
                    'calendar' => 'write',
                    'reports' => 'read',
                    'documents' => 'write',
                    'claims' => 'write',
                    'settings' => 'none',
                    'access' => 'none',
                ],
                'is_super_admin' => false,
            ]
        );

        Role::firstOrCreate(
            ['slug' => 'compliance-specialist'],
            [
                'name' => 'Compliance Specialist',
                'description' => 'Reviews compliance, claims, and audit documentation',
                'permissions' => [
                    'dashboard' => 'read',
                    'clients' => 'read',
                    'policies' => 'read',
                    'leads' => 'none',
                    'tasks' => 'write',
                    'calendar' => 'read',
                    'reports' => 'write',
                    'documents' => 'read',
                    'claims' => 'write',
                    'settings' => 'none',
                    'access' => 'none',
                ],
                'is_super_admin' => false,
            ]
        );
    }
}
