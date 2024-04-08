<?php

namespace Tests\Feature\Admin;

use Database\Seeders\AdminSeeder;
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
        $this->seed(AdminSeeder::class);
        $response = $this->post('/admins/login', [
            'email' => 'admin@example.com',
            'password' => 'admin12345',
            'remember' => true
        ]);

        $response->assertSessionHasNoErrors();
    }
}
