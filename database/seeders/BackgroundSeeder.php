<?php

namespace Database\Seeders;

use App\Models\Background;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BackgroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrFail();

        Background::create([
            'content' => 'Content background',
            'user_id' => $user->id
        ]);
    }
}
