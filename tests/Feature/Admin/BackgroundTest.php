<?php

namespace Tests\Feature\Admin;

use App\Models\Background;
use App\Models\User;
use Database\Seeders\AdminSeeder;
use Database\Seeders\BackgroundSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class BackgroundTest extends TestCase
{
    public function testSuccess(): void
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $response = $this->patch('/background', [
            'content' => 'Ini latar belakang',
        ], [
            "Authorization" => "admin"
        ]);

        $this->assertTrue(Gate::allows('create', Background::class));

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/background');
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success', 'Data berhasil');
    }

    public function testUpdateUnauthorized(): void
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, BackgroundSeeder::class]);

        $response = $this->patch('/background', [
            'content' => 'Ini latar belakang',
        ], [
            "Authorization" => "salah"
        ]);

        Log::info(json_encode($response, JSON_PRETTY_PRINT));

        $response->assertStatus(401);
        $response->assertSessionHasNoErrors();
    }

    public function testUpdateRequestInvalid(): void
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, BackgroundSeeder::class]);

        $response = $this->patch('/background', [
            'content' => '',
        ], [
            "Authorization" => "admin"
        ]);

        Log::info(json_encode($response, JSON_PRETTY_PRINT));

        $response->assertStatus(302);
        $response->assertSessionHasErrors();
    }

    public function testUpdateWithoutPermission(): void
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, BackgroundSeeder::class]);

        $response = $this->patch('/background', [
            'content' => 'Ini adalah latar belakang',
        ], [
            "Authorization" => "ketua_ukm"
        ]);

        $response->assertStatus(403);
        $response->assertSessionHasNoErrors();
    }
}
