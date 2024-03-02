<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('roles')->insert([
            'name' => 'Admin',
        ]);

        DB::table('roles')->insert([
            'name' => 'User',
        ]);

        // Groups
        DB::table('groups')->insert([
            'name' => 'Group A',
        ]);

        DB::table('groups')->insert([
            'name' => 'Group B',
        ]);

        // Categories
        DB::table('categories')->insert([
            'name' => 'Category X',
        ]);

        DB::table('categories')->insert([
            'name' => 'Category Y',
        ]);

        // Users
        DB::table('users')->insert([
            'username' => 'user1',
            'email' => 'user1@example.com',
            'password' => bcrypt('password'),
            'role_id' => 1, // Assuming Admin role_id is 1
        ]);

        DB::table('users')->insert([
            'username' => 'user2',
            'email' => 'user2@example.com',
            'password' => bcrypt('password'),
            'role_id' => 2, // Assuming User role_id is 2
        ]);

        // Contacts
        DB::table('contacts')->insert([
            'email' => 'contact1@example.com',
            'group_id' => 1, // Assuming Group A has group_id 1
        ]);

        DB::table('contacts')->insert([
            'email' => 'contact2@example.com',
            'group_id' => 2, // Assuming Group B has group_id 2
        ]);
    }
}
