<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSuccess(): void
    {
        $response = $this->post('/admins', [
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'admin12345',
            'password_confirmation' => 'admin12345',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
    }

    public function testValidationError(): void
    {
        $response = $this->post('/admins', [
            'name' => 'test',
            'email' => 'test',
            'password' => 'test12345',
            'password_confirmation' => 'test',
        ])->assertStatus(302);

        $response->assertSessionHasErrors();
    }

    public function testEmailRegistered(): void
    {
        $this->testSuccess();

        $response = $this->post('/admins', [
            'name' => 'test',
            'email' => 'admin@example.com',
            'password' => 'admin2345',
            'password_confirmation' => 'admin2345',
        ]);

        $response->assertSessionHasErrors();
    }
}
