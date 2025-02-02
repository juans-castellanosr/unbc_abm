<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'User',
            'lastname' => 'Test',
            'email' => 'test@test.com',
            'phone_number' => '+57 0000000000',
            'password' => '$2y$12$8Ub9xQ.1HAdphnqSK3ZXDO4rMDHCkoslTopPNyqGm2ors60S9zzt6',
            'created_at' => '2025-01-10 17:35:35',
            'updated_at' => '2025-01-11 17:05:04'
        ]);
    }
}
