<?php

namespace Tests\Feature\Admin;

use Database\Seeders\AdminSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testLoginSuccess(): void
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class]);
        $response = $this->post('/admins/login', [
            'email' => 'admin@example.com',
            'password' => 'admin12345',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function testLoginFailed()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class]);
        $response = $this->post('/admins/login', [
            'email' => 'admin@example.com',
            'password' => 'salah',
        ]);

        $response->assertSessionHasErrors();
    }

    public function testLoginNotAdmin(): void
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class]);
        $response = $this->post('/admins/login', [
            'email' => 'admin@example.com',
            'password' => 'admin12345',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
    }

    public function testLogoutSuccess()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class]);

        $response = $this->post('/logout', [
            'email' => 'admin@example.com',
            'password' => 'admin12345',
        ], [
            'Authorization' => 'token123'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
    }
}
