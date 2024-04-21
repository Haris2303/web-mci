<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'description' => 'role admin'
        ]);

        Role::create([
            'name' => 'leader',
            'description' => 'role leader'
        ]);

        Role::create([
            'name' => 'member',
            'description' => 'role member'
        ]);
    }
}
