<?php

namespace Database\Seeders;

use App\Models\Devision;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DevisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@example.com')->first();

        Devision::create([
            'name' => 'Programming dan Robotika',
            'content' => 'Ini Content',
            'user_id' => $user->id
        ]);
    }
}
