<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{
    User,
    Role,
    Permission
};
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            ['name' => 'Super Admin', 'username' => 'superadmin','phone_code'=>'+92', 'phone' => '1111111111', 'email' => 'superadmin@example.com', 'password' => bcrypt('12345678')],
            ['name' => 'Admin', 'username' => 'admin','phone_code'=>'+92', 'phone' => '2222222222', 'email' => 'admin@example.com', 'password' => bcrypt('12345678')],
            ['name' => 'Manager', 'username' => 'manager','phone_code'=>'+92', 'phone' => '3333333333', 'email' => 'manager@example.com', 'password' => bcrypt('12345678')],
            ['name' => 'User', 'username' => 'user','phone_code'=>'+92', 'phone' => '4444444444', 'email' => 'user@example.com', 'password' => bcrypt('12345678')],
            ['name' => 'User2', 'username' => 'user2','phone_code'=>'+92', 'phone' => '5555555555', 'email' => 'user2@example.com', 'password' => bcrypt('12345678')],
        ]);

        Role::insert([
            ['name' => 'Super Admin', 'slug' => 'super-admin'],
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'Manager', 'slug' => 'manager'],
            ['name' => 'User', 'slug' => 'user'],
        ]);


        Permission::insert([
            ['name' => 'Add Post', 'slug' => 'add-post'],
            ['name' => 'Edit Post', 'slug' => 'edit-post'],
            ['name' => 'Delete Post', 'slug' => 'delete-post'],
            ['name' => 'View Post', 'slug' => 'view-post'],
            ['name' => 'Posts', 'slug' => 'posts'],
        ]);

        DB::table('users_roles')->insert(['user_id'=>1, 'role_id' => 1 ]);

        DB::table('users_permissions')->insert([
            ['user_id'=>1, 'permission_id' => 1 ],
            ['user_id'=>1, 'permission_id' => 2 ],
            ['user_id'=>1, 'permission_id' => 3 ],
            ['user_id'=>1, 'permission_id' => 4 ],
            ['user_id'=>1, 'permission_id' => 5 ],
        ]);

    }
}
