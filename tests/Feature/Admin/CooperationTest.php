<?php

namespace Tests\Feature\Admin;

use App\Models\Cooperation;
use Database\Seeders\AdminSeeder;
use Database\Seeders\CooperationSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CooperationTest extends TestCase
{
    public function testCreateSuccess()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        Storage::fake('coopeartions');
        $file = UploadedFile::fake('coopeartions')->image('cooperations.jpg');

        $this->post('/cooperations', [
            'image' => $file,
            'content' => 'Ini adalah content kerja sama'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testCreateInvalid()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        Storage::fake('coopeartions');
        $file = UploadedFile::fake('coopeartions')->image('cooperations.jpg');

        $this->post('/cooperations', [
            'image' => $file,
            'content' => ''
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testCreateUnauthorized()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        Storage::fake('coopeartions');
        $file = UploadedFile::fake('coopeartions')->image('cooperations.jpg');

        $this->post('/cooperations', [
            'image' => $file,
            'content' => 'Ini adalah content kerja sama'
        ], [
            'Authorization' => 'salah'
        ])->assertStatus(401)->assertSessionHasNoErrors();
    }

    public function testUpdateSuccess()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, PermissionSeeder::class, CooperationSeeder::class]);

        Storage::fake('coopeartions');
        $file = UploadedFile::fake('coopeartions')->image('cooperations.jpg');

        $cooperation = Cooperation::first();

        $this->put("/cooperations/$cooperation->id", [
            'image' => $file,
            'content' => 'Ini adalah content kerja sama baru'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testUpdateInvalid()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, PermissionSeeder::class, CooperationSeeder::class]);

        Storage::fake('coopeartions');
        $file = UploadedFile::fake('coopeartions')->image('cooperations.jpg');

        $cooperation = Cooperation::first();

        $this->put("/cooperations/$cooperation->id", [
            'image' => $file,
            'content' => ''
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testUpdateNotFound()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, PermissionSeeder::class, CooperationSeeder::class]);

        Storage::fake('coopeartions');
        $file = UploadedFile::fake('coopeartions')->image('cooperations.jpg');

        $cooperation = Cooperation::first();

        $id = $cooperation->id + 1;

        $this->put("/cooperations/$id", [
            'image' => $file,
            'content' => 'Ini adalah content kerja sama baru'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(404)->assertSessionHasNoErrors();
    }

    public function testUpdateUnauthorized()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, PermissionSeeder::class, CooperationSeeder::class]);

        Storage::fake('coopeartions');
        $file = UploadedFile::fake('coopeartions')->image('cooperations.jpg');

        $cooperation = Cooperation::first();

        $id = $cooperation->id;

        $this->put("/cooperations/$id", [
            'image' => $file,
            'content' => 'Ini adalah content kerja sama baru'
        ], [
            'Authorization' => 'salah'
        ])->assertStatus(401)->assertSessionHasNoErrors();
    }

    public function testDeleteSuccess()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, PermissionSeeder::class, CooperationSeeder::class]);

        $cooperation = Cooperation::first();
        $id = $cooperation->id;

        $this->delete("/cooperations/$id", headers: [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testDeleteNotFound()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, PermissionSeeder::class, CooperationSeeder::class]);

        $cooperation = Cooperation::first();
        $id = $cooperation->id + 1;

        $this->delete("/cooperations/$id", headers: [
            'Authorization' => 'admin'
        ])->assertStatus(404)->assertSessionHasNoErrors();
    }

    public function testDeleteUnauthorized()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, PermissionSeeder::class, CooperationSeeder::class]);

        $cooperation = Cooperation::first();
        $id = $cooperation->id;

        $this->delete("/cooperations/$id", headers: [
            'Authorization' => 'salah'
        ])->assertStatus(401)->assertSessionHasNoErrors();
    }
}
