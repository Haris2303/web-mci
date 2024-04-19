<?php

namespace Database\Seeders;

use App\Models\LeadershipStructure;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadershipStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@example.com')->first();

        LeadershipStructure::create([
            'image' => 'leadership_structures/gambar.jpg',
            'description' => 'Deskripsi leadership test',
            'user_id' => $user->id
        ]);
    }
}
