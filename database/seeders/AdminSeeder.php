<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin12345'),
            'remember_token' => 'token123',
            'is_active' => true
        ]);

        User::create([
            'name' => 'admin2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('admin12345'),
            'remember_token' => 'admin2',
            'is_active' => true
        ]);
    }
}
