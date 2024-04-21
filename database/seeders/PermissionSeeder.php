<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name', 'admin')->first();

        $permission = new Permission();
        $permission->name = 'upsert-background';
        $permission->description = 'Permizinan membuat atau mengupdate latar belakang website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'upsert-vision-mision';
        $permission->description = 'Permizinan membuat atau mengupdate visi misi website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $role = Role::where('name', 'leader')->first();
        $permission = new Permission();
        $permission->name = 'test';
        $permission->description = 'test';
        $permission->save();
        $permission->roles()->attach($role->id);
    }
}
