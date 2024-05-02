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
        $permission->description = 'Permizinan melihat banyak devisi';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'view-devision';
        $permission->description = 'Permizinan melihat devisi';
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

        // permission cooperation
        $permission = new Permission();
        $permission->name = 'viewAny-cooperation';
        $permission->description = 'Permizinan melihat semua kerja sama website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'view-cooperation';
        $permission->description = 'Permizinan melihat kerja sama website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'create-cooperation';
        $permission->description = 'Permizinan membuat kerja sama website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'update-cooperation';
        $permission->description = 'Permizinan mengubah kerja sama website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'delete-cooperation';
        $permission->description = 'Permizinan menghapus kerja sama website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'restore-cooperation';
        $permission->description = 'Permizinan memulihkan kerja sama website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'forceDelete-cooperation';
        $permission->description = 'Permizinan delete permanen kerja sama website';
        $permission->save();
        $permission->roles()->attach($role->id);

        // permission gallery
        $permission = new Permission();
        $permission->name = 'viewAny-gallery';
        $permission->description = 'Permizinan melihat semua galeri website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'view-gallery';
        $permission->description = 'Permizinan melihat detail galeri website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'view-gallery';
        $permission->description = 'Permizinan melihat detail galeri website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'create-gallery';
        $permission->description = 'Permizinan membuat galeri website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'update-gallery';
        $permission->description = 'Permizinan mengubah galeri website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'delete-gallery';
        $permission->description = 'Permizinan menghapus galeri website';
        $permission->save();
        $permission->roles()->attach($role->id);

        // permission project
        $permission = new Permission();
        $permission->name = 'viewAny-project';
        $permission->description = 'Permizinan melihat semua project website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'view-project';
        $permission->description = 'Permizinan melihat detail project website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'view-project';
        $permission->description = 'Permizinan melihat detail project website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'create-project';
        $permission->description = 'Permizinan membuat project website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'update-project';
        $permission->description = 'Permizinan mengubah project website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'delete-project';
        $permission->description = 'Permizinan menghapus project website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'restore-project';
        $permission->description = 'Permizinan memulihkan project website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'forceDelete-project';
        $permission->description = 'Permizinan delete permanen project website';
        $permission->save();
        $permission->roles()->attach($role->id);

        // Permission About Us
        $permission = new Permission();
        $permission->name = 'viewAny-aboutUs';
        $permission->description = 'Permizinan melihat tentang kami website';
        $permission->save();
        $permission->roles()->attach($role->id);

        $permission = new Permission();
        $permission->name = 'create-aboutUs';
        $permission->description = 'Permizinan membuat tentang kami website';
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
