<?php

namespace Tests\Feature\Admin;

use App\Models\Gallery;
use Database\Seeders\AdminSeeder;
use Database\Seeders\GallerySeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    public function testCreateSuccess()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        Storage::fake('gallery');
        $file = UploadedFile::fake()->image('gallery.jpg');

        $this->post('/galleries', [
            'image' => $file
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testCreateInvalid()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class]);

        $this->post('/galleries', [
            'image' => ''
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testCreateUnauthorized()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class]);

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
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, GallerySeeder::class]);

        $gallery = Gallery::first();

        $this->delete("/galleries/$gallery->id", headers: [
            'Authorization' => 'admin'
        ])->assertStatus(302);
    }

    public function testDeleteNotFound()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, GallerySeeder::class]);

        $this->delete("/galleries/1", headers: [
            'Authorization' => 'admin'
        ])->assertStatus(404);
    }

    public function testDeleteUnauthorized()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, GallerySeeder::class]);

        $this->delete("/galleries/1", headers: [
            'Authorization' => 'ketua_ukm'
        ])->assertStatus(401);
    }
}
