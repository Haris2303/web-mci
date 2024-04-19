<?php

namespace Tests\Feature\Admin;

use App\Models\Gallery;
use Database\Seeders\AdminSeeder;
use Database\Seeders\GallerySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    public function testCreateSuccess()
    {
        $this->seed(AdminSeeder::class);

        Storage::fake('gallery');
        $file = UploadedFile::fake()->image('gallery.jpg');

        $this->post('/galleries', [
            'image' => $file
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testCreateInvalid()
    {
        $this->seed(AdminSeeder::class);

        $this->post('/galleries', [
            'image' => ''
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testCreateUnauthorized()
    {
        $this->seed(AdminSeeder::class);

        Storage::fake('gallery');
        $file = UploadedFile::fake()->image('gallery.jpg');

        $this->post('/galleries', [
            'image' => $file
        ], [
            'Authorization' => 'salah'
        ])->assertStatus(401);
    }

    public function testDeleteSuccess()
    {
        $this->seed([AdminSeeder::class, GallerySeeder::class]);

        $gallery = Gallery::first();

        $this->delete("/galleries/$gallery->id", headers: [
            'Authorization' => 'token123'
        ])->assertStatus(302);
    }

    public function testDeleteNotFound()
    {
        $this->seed([AdminSeeder::class, GallerySeeder::class]);

        $this->delete("/galleries/1", headers: [
            'Authorization' => 'token123'
        ])->assertStatus(404);
    }
}
