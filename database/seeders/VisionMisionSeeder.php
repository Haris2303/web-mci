<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VisionMision; // Pastikan menggunakan namespace yang benar untuk model VisionMision
use App\Models\User; // Import model User

class VisionMisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan Anda sudah memiliki setidaknya satu user di tabel users
        $user = User::first(); // Mengambil user pertama sebagai contoh

        // Membuat record baru di tabel vision_misions
        VisionMision::create([
            'content' => 'Ini adalah contoh isi dari visi dan misi.', // Contoh isi dari field content
            'user_id' => $user->id, // Menggunakan user_id dari user yang diambil sebelumnya
        ]);
    }
}
