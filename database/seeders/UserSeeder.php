<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // === Customers ===
        User::factory()->create([
            'name' => 'John Customer',
            'email' => 'zain@example.com',
            'password' => Hash::make('11223344'),
            'role' => 'customer',
        ]);

        User::factory()->create([
            'name' => 'Sarah User',
            'email' => 'sarah@example.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
        ]);

        User::factory()->create([
            'name' => 'Mike Tester',
            'email' => 'mike@example.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
        ]);

        // === Agents / Support Staff ===
        User::factory()->create([
            'name' => 'Emma Support',
            'email' => 'emma@support.com',
            'password' => Hash::make('password123'),
            'role' => 'agent',
        ]);

        User::factory()->create([
            'name' => 'Zain Support',
            'email' => 'zain@support.com',
            'password' => Hash::make('11223344'),
            'role' => 'agent',
        ]);

        // === Admin ===
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
    }
}