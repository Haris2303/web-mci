<?php

namespace Tests\Feature\Admin;

use App\Models\LeadershipStructure;
use App\Models\User;
use Database\Seeders\AdminSeeder;
use Database\Seeders\LeadershipStructureSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LeadershipStructureTest extends TestCase
{
    public function testUpsertSuccess()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $user = User::where('email', 'admin@example.com')->first();

        Auth::login($user);

        Storage::fake('leadership');

        $file = UploadedFile::fake()->image('leadership.jpg');

        $this->patch('/leadership-structures', [
            'image' => $file,
            'description' => 'Ini adalah deskripsi'
        ])->assertStatus(302)->assertSessionHasNoErrors();

        $this->assertTrue(Gate::allows('create', LeadershipStructure::class));

        $data = LeadershipStructure::first();
        $this->assertEquals($data->description, 'Ini adalah deskripsi');
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
