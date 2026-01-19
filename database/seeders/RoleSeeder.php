<?php

namespace Database\Seeders; 

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manajemen',
                'guard_name' => 'web',
            ],
            [
                'name' => 'kaprodi',
                'guard_name' => 'web',
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        // assign admin user to admin role
        $admin = User::with('roles')->where('email', 'admin@mail.com')->first();
        $admin->assignRole('admin');
    }
}
