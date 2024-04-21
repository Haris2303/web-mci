<?php

namespace Tests\Feature\Admin;

use Database\Seeders\AdminSeeder;
use Database\Seeders\LeadershipStructureSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LeadershipStructureTest extends TestCase
{
    public function testUpsertSuccess()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class]);

        Storage::fake('leadership');

        $file = UploadedFile::fake()->image('leadership.jpg');

        $this->patch('/leadership_structures', [
            'image' => $file,
            'description' => 'Ini adalah deskripsi'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testUpsertInvalid()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class]);

        Storage::fake('leadership');

        $file = UploadedFile::fake()->image('leadership.jpg');

        $this->patch('/leadership_structures', [
            'image' => $file,
            'description' => ''
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testUpsertUnauthorized()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class]);

        Storage::fake('leadership');

        $file = UploadedFile::fake()->image('leadership.jpg');

        $this->patch('/leadership_structures', [
            'image' => $file,
            'description' => 'Ini deskripsi'
        ], [
            'Authorization' => 'salah'
        ])->assertStatus(401)->assertSessionHasNoErrors();
    }

    public function testUpserSuccessForUpdate()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, LeadershipStructureSeeder::class]);

        Storage::fake('leadership');

        $file = UploadedFile::fake()->image('leadership.jpg');

        $this->patch('/leadership_structures', [
            'image' => $file,
            'description' => 'Ini deskripsi'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }
}
