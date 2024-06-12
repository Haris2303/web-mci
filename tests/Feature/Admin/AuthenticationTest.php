<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Database\Seeders\AdminSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/admin');
        $response->assertSessionHasNoErrors();

        $this->get('/dashboard/admin', [
            'Authorization' => Auth::user()->getRememberToken()
        ])->assertStatus(200)->assertSeeText('Flowbite');
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

    public function testRedirectToDashboardAdmin()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class]);

        // $this->get('/dashboard/admin', [
        //     'Authorization' => 'admin'
        // ])->assertStatus(200)->assertSeeText('flowbite');

        $user = User::where('email', 'ketua@example.com')->first();

        $response = Http::withHeaders([
            'Content-Type' => 'text/html',
            'Authorization', $user->getRememberToken()
        ])->get('http://localhost:8001/dashboard');

        $this->assertEquals(200, $response->ok());
    }
}
