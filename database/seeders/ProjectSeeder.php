<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@example.com')->first();

        Project::create([
            'image' => 'projects/test.jpg',
            'title' => 'Judul test',
            'slug' => 'judul-test',
            'description' => 'Description test',
            'type' => 'UKM',
            'user_id' => $user->id
        ]);
    }
}
