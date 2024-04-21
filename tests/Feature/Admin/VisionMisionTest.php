<?php

namespace Tests\Feature\Admin;

use Database\Seeders\AdminSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\VisionMisionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VisionMisionTest extends TestCase
{
    public function testSuccess(): void
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, VisionMisionSeeder::class]);

        $response = $this->patch('/vision-mision', [
            'content' => 'Ini adalah visi misi baru'
        ], [
            'Authorization' => 'admin'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
    }

    public function testUpdateRequestInvalid(): void
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, VisionMisionSeeder::class]);

        $this->patch('/vision-mision', [
            'content' => ''
        ], [
            'Authorization' => 'admin'
        ])->assertSessionHasErrors();
    }

    public function testUpdateUnauthorized(): void
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, VisionMisionSeeder::class]);

        $this->patch('/vision-mision', [
            'content' => 'Ini adalah visi misi baru'
        ])->assertStatus(401);
    }
}
