<?php

namespace Database\Seeders;

use App\Models\Cooperation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CooperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        Cooperation::create([
            'image' => 'cooperations/gambar.jpg',
            'content' => 'Content kerja sama test',
            'user_id' => $user->id
        ]);
    }
}
