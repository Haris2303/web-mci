<?php

namespace Tests\Feature\Admin;

use App\Models\Devision;
use App\Models\User;
use Database\Seeders\AdminSeeder;
use Database\Seeders\DevisionSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class DevisionTest extends TestCase
{
    public function testCreateSuccess()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->post('/devisions', [
            'name' => 'Programming',
            'content' => 'Content Programming'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testCreateInvalid()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->post('/devisions', [
            'name' => '',
            'content' => ''
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testCreateUnauthorized()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->post('/devisions', [
            'name' => 'Programming',
            'content' => 'Content Programming'
        ], [
            'Authorization' => 'salah'
        ])->assertStatus(401);
    }

    public function testCreateWithoutPermission()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->post('/devisions', [
            'name' => 'Programming',
            'content' => 'Content Programming'
        ], [
            'Authorization' => 'ketua_ukm'
        ])->assertStatus(403);
    }

    public function testUpdateSuccess()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

        $devision = Devision::first();

        $this->put("/devisions/$devision->id", [
            'name' => 'Desain Grafis',
            'content' => 'Content Desain Grafis'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302);

        $this->assertTrue(Gate::allows('update', $devision));
    }

    public function testUpdateInvalid()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

        $devision = Devision::first();

        $this->put("/devisions/$devision->id", [
            'name' => '',
            'content' => ''
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testUpdateUnauthorized()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

        $devision = Devision::first();

        $this->put("/devisions/$devision->id", [
            'name' => 'Desain Grafis',
            'content' => 'Content Desain Grafis'
        ], [
            'Authorization' => 'salah'
        ])->assertStatus(401);
    }

    public function testUpdateIdNotFound()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

        $devision = Devision::first();
        $id = $devision->id + 1;

        $this->put("/devisions/$id", [
            'name' => 'Desain Grafis',
            'content' => 'Content Desain Grafis'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(404);
    }

    public function testUpdateWithoutPermission()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

        $devision = Devision::first();

        $this->put("/devisions/$devision->id", [
            'name' => 'Desain Grafis',
            'content' => 'Content Desain Grafis'
        ], [
            'Authorization' => 'ketua_ukm'
        ])->assertStatus(403);
    }

    public function testDeleteSuccess()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

        $devision = Devision::first();

        $this->delete("/devisions/$devision->id", headers: [
            'Authorization' => 'admin'
        ])->assertStatus(302);
    }

    public function testDeleteNotFound()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

        $this->delete("/devisions/1", headers: [
            'Authorization' => 'admin'
        ])->assertStatus(404);
    }

    public function testDeleteUnauthorization()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

        $devision = Devision::first();

        $this->delete("/devisions/$devision->id", headers: [
            'Authorization' => 'salah'
        ])->assertStatus(401);
    }

    public function testDeleteWithoutPermission()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

        $devision = Devision::first();

        $this->delete("/devisions/$devision->id", headers: [
            'Authorization' => 'ketua_ukm'
        ])->assertStatus(403);
    }
}
