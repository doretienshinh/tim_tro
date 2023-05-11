<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $roles = [
            'admin',
            'user',
            'host'
        ];

        $permissions = [
            'user_access',
            'user_show',
            'user_create',
            'user_edit',
            'user_delete',
            'role_access',
            'role_show',
            'role_create',
            'role_edit',
            'role_delete',
            'permission_access',
            'permission_show',
            'permission_create',
            'permission_edit',
            'permission_delete',
        ];

        $users = [
            [
                'name' => 'CMS Administrator',
                'email' => 'admin@timtro.cms',
                'password' => bcrypt('00000000'),
                'email_verified_at' => Carbon::now()->timestamp
            ]
        ];

        // Create and give permissions to roles
        // If role is admin => give all permission => using Gate::before in AuthServiceProvider

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        foreach ($roles as $role) {
            $newRole = Role::create(['name' => $role]);

            if ($role == 'user') {
                $rolePermission = [
                    'user_show',
                    'role_show',
                    'permission_show',
                ];

                $newRole->givePermissionTo($rolePermission);
            }
        }

        // Create user and give role to user
        foreach ($users as $user) {
            $newUser = User::create($user);

            if ($user['email'] == 'admin@caerux.cms') {
                $newUser->assignRole('admin');
            } 
            else {
                $newUser->assignRole('user');
            }
        }
    }
}
