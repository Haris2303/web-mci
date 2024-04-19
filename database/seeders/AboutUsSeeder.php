<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrFail();

        AboutUs::create([
            'content' => 'Content About Test',
            'user_id' => $user->id
        ]);
    }
}
