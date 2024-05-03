<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $roles = Role::first();
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@example.com';
        $user->password = Hash::make('admin12345');
        $user->remember_token = 'admin';
        $user->is_active = true;
        $user->save();
        $user->roles()->attach($roles->id);

        $user = new User();
        $user->name = 'admin2';
        $user->email = 'admin2@example.com';
        $user->password = Hash::make('admin12345');
        $user->remember_token = 'admin2';
        $user->is_active = true;
        $user->save();
        $user->roles()->attach($roles->id);

        $roles = Role::where('name', 'leader')->first();
        $user = new User();
        $user->name = 'Ketua UKM';
        $user->email = 'ketua@example.com';
        $user->password = Hash::make('ketua12345');
        $user->remember_token = 'ketua_ukm';
        $user->is_active = true;
        $user->save();
        $user->roles()->attach($roles->id);

        $roles = Role::where('name', 'member')->first();
        $user = new User();
        $user->name = 'Member UKM';
        $user->email = 'member@example.com';
        $user->password = Hash::make('member12345');
        $user->remember_token = 'member';
        $user->is_active = true;
        $user->save();
        $user->roles()->attach($roles->id);
    }
}
