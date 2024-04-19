<?php

namespace Tests\Feature\Admin;

use App\Models\Cooperation;
use Database\Seeders\AdminSeeder;
use Database\Seeders\CooperationSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CooperationTest extends TestCase
{
    public function testCreateSuccess()
    {
        $this->seed(AdminSeeder::class);

        Storage::fake('coopeartions');
        $file = UploadedFile::fake('coopeartions')->image('cooperations.jpg');

        $this->post('/cooperations', [
            'image' => $file,
            'content' => 'Ini adalah content kerja sama'
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testCreateInvalid()
    {
        $this->seed(AdminSeeder::class);

        Storage::fake('coopeartions');
        $file = UploadedFile::fake('coopeartions')->image('cooperations.jpg');

        $this->post('/cooperations', [
            'image' => $file,
            'content' => ''
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testCreateUnauthorized()
    {
        $this->seed(AdminSeeder::class);

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
        $this->seed([AdminSeeder::class, CooperationSeeder::class]);

        Storage::fake('coopeartions');
        $file = UploadedFile::fake('coopeartions')->image('cooperations.jpg');

        $cooperation = Cooperation::first();

        $this->put("/cooperations/$cooperation->id", [
            'image' => $file,
            'content' => 'Ini adalah content kerja sama baru'
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testUpdateInvalid()
    {
        $this->seed([AdminSeeder::class, CooperationSeeder::class]);

        Storage::fake('coopeartions');
        $file = UploadedFile::fake('coopeartions')->image('cooperations.jpg');

        $cooperation = Cooperation::first();

        $this->put("/cooperations/$cooperation->id", [
            'image' => $file,
            'content' => ''
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testUpdateNotFound()
    {
        $this->seed([AdminSeeder::class, CooperationSeeder::class]);

        Storage::fake('coopeartions');
        $file = UploadedFile::fake('coopeartions')->image('cooperations.jpg');

        $cooperation = Cooperation::first();

        $id = $cooperation->id + 1;

        $this->put("/cooperations/$id", [
            'image' => $file,
            'content' => 'Ini adalah content kerja sama baru'
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(404)->assertSessionHasNoErrors();
    }

    public function testUpdateUnauthorized()
    {
        $this->seed([AdminSeeder::class, CooperationSeeder::class]);

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
        $this->seed([AdminSeeder::class, CooperationSeeder::class]);

        $cooperation = Cooperation::first();
        $id = $cooperation->id;

        $this->delete("/cooperations/$id", headers: [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testDeleteNotFound()
    {
        $this->seed([AdminSeeder::class, CooperationSeeder::class]);

        $cooperation = Cooperation::first();
        $id = $cooperation->id + 1;

        $this->delete("/cooperations/$id", headers: [
            'Authorization' => 'token123'
        ])->assertStatus(404)->assertSessionHasNoErrors();
    }

    public function testDeleteUnauthorized()
    {
        $this->seed([AdminSeeder::class, CooperationSeeder::class]);

        $cooperation = Cooperation::first();
        $id = $cooperation->id;

        $this->delete("/cooperations/$id", headers: [
            'Authorization' => 'salah'
        ])->assertStatus(401)->assertSessionHasNoErrors();
    }
}
