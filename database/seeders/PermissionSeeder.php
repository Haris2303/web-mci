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

        // role admin
        $role = Role::where('name', 'admin')->first();

        // permission background
        $permission = new Permission();
        $permission->name = 'upsert-background';
        $permission->description = 'Permizinan membuat atau mengupdate latar belakang website';
        $permission->save();
        $permission->roles()->attach($role->id);

        // permission vision mision
        $permission = new Permission();
        $permission->name = 'upsert-visionMision';
        $permission->description = 'Permizinan membuat atau mengupdate visi misi website';
        $permission->save();
        $permission->roles()->attach($role->id);

        // permision devision
        $permission = new Permission();
        $permission->name = 'viewAny-devision';
        $permission->description = 'Permizinan membuat devisi';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'view-devision';
        $permission->description = 'Permizinan membuat devisi';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'create-devision';
        $permission->description = 'Permizinan membuat devisi';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'update-devision';
        $permission->description = 'Permizinan mengubah devisi';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'delete-devision';
        $permission->description = 'Permizinan menghapus devisi';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'restore-devision';
        $permission->description = 'Permizinan menghapus devisi';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'forceDelete-devision';
        $permission->description = 'Permizinan menghapus devisi';
        $permission->save();
        $permission->roles()->attach($role->id);

        // permission leadership structure
        $permission = new Permission();
        $permission->name = 'upsert-leadershipStructure';
        $permission->description = 'Permizinan membuat atau mengupdate struktur kepemimpinan website';
        $permission->save();
        $permission->roles()->attach($role->id);


        // role leader
        $role = Role::where('name', 'leader')->first();
        $permission = new Permission();
        $permission->name = 'test';
        $permission->description = 'test';
        $permission->save();
        $permission->roles()->attach($role->id);
    }
}
