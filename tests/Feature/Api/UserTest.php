<?php

namespace Tests\Feature\Api;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\AdminSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    private $routeLogin = '/api/users/login';

    public function testLoginSuccess()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->post($this->routeLogin, [
            'email' => 'admin@example.com',
            'password' => 'admin12345'
        ])->assertStatus(200)->assertJson([
            'data' => [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'is_active' => 1
            ]
        ]);
    }

    public function testLoginInvalid()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->post($this->routeLogin, [
            'email' => '',
            'password' => ''
        ])->assertStatus(400)->assertJson([
            'errors' => [
                'email' => [
                    'The email field is required.'
                ],
                'password' => [
                    'The password field is required.'
                ]
            ]
        ]);
    }

    public function testLoginPasswordWrong()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->post($this->routeLogin, [
            'email' => 'admin@example.com',
            'password' => 'salah'
        ])->assertStatus(401)->assertJson([
            'errors' => [
                'message' => [
                    'username or password wrong'
                ]
            ]
        ]);
    }

    public function testRegisterSuccess()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $role = Role::where('name', 'member')->first();

        $this->post('/api/users', [
            'name' => 'Test dua',
            'email' => 'test2@example.com',
            'password' => 'test12345',
            'password_confirmation' => 'test12345',
            'role_id' => $role->id
        ], [
            'Accept' => 'application/json',
            'Authorization' => 'admin'
        ])->assertStatus(201)->assertJson([
            'data' => [
                'name' => 'Test dua',
                'email' => 'test2@example.com',
                'is_active' => 1
            ]
        ]);
    }

    public function testRegisterInvalid()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class]);

        $this->post('/api/users', [
            'name' => '',
            'email' => 'admin@example.com',
            'password' => 'admin12345',
            'password_confirmation' => 'admin12345'
        ])->assertStatus(400)->assertJson([
            'errors' => [
                'name' => [
                    'The name field is required.'
                ]
            ]
        ]);
    }

    public function testRegisterPasswordConfirmationInvalid()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class]);

        $this->post('/api/users', [
            'name' => 'Admin Test',
            'email' => 'admin@example.com',
            'password' => 'admin12345',
            'password_confirmation' => 'salah'
        ])->assertStatus(400)->assertJson([
            'errors' => [
                'password' => [
                    'The password field confirmation does not match.'
                ]
            ]
        ]);
    }

    public function testGetSuccessCurrent()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->get('/api/users/current', [
            'accept' => 'application/json',
            'Authorization' => 'admin'
        ])->assertStatus(200)->assertJson([
            'data' => [
                'name' => 'admin',
                'email' => 'admin@example.com'
            ]
        ]);
    }

    public function testGetUnauthorized()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->get('/api/users/current', [
            'accept' => 'application/json',
            'Authorization' => 'salah'
        ])->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }

    public function testUpdateNameSuccess()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->patch('/api/users/current', [
            'name' => 'Admin Baru'
        ], [
            'accept' => 'application/json',
            'Authorization' => 'admin'
        ])->assertStatus(200)->assertJson([
            'data' => [
                'name' => 'Admin Baru'
            ]
        ]);
    }

    public function testUpdatePasswordSuccess()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->patch('/api/users/current', [
            'password' => 'password_baru'
        ], [
            'accept' => 'application/json',
            'Authorization' => 'admin'
        ])->assertStatus(200)->assertJson([
            'data' => [
                'name' => 'admin'
            ]
        ]);

        $user = User::where('email', 'admin@example.com')->first();
        $this->assertTrue(Hash::check('password_baru', $user->password));
    }

    public function testUpdateUnauthorized()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->patch('/api/users/current', [
            'name' => 'Admin Baru'
        ], [
            'accept' => 'application/json',
            'Authorization' => 'salah'
        ])->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }

    public function testUpdateInvalid()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->patch('/api/users/current', [
            'name' => ''
        ], [
            'accept' => 'application/json',
            'Authorization' => 'admin'
        ])->assertStatus(200)->assertJson([
            'data' => [
                'name' => 'admin'
            ]
        ]);
    }

    public function testLogoutSuccess()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->delete('/api/users/logout', headers: [
            'accept' => 'application/json',
            'Authorization' => 'admin'
        ])->assertStatus(200)->assertJson([
            'data' => true
        ]);

        $user = User::where('email', 'admin@example.com')->first();
        $this->assertNull($user->remember_token);
    }

    public function testLogoutFailed()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->delete(uri: '/api/users/logout', headers: [
            'accept' => 'application/json',
            'Authorization' => 'salah'
        ])->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }

    public function testDeleteUser()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $user = User::where('email', 'member@example.com')->first();

        $this->delete(uri: '/api/users/' . $user->id, headers: [
            'accept' => 'application/json',
            'Authorization' => 'admin'
        ])->assertStatus(200)->assertJson([
            'data' => true
        ]);

        $user = User::where('email', 'member@example.com')->first();
        $this->assertNull($user);
    }
}
