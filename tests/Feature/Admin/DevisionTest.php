<?php

namespace Tests\Feature\Admin;

use App\Models\Devision;
use Database\Seeders\AdminSeeder;
use Database\Seeders\DevisionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DevisionTest extends TestCase
{
    public function testCreateSuccess()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class]);

        $this->post('/devisions', [
            'name' => 'Programming',
            'content' => 'Content Programming'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testCreateInvalid()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class]);

        $this->post('/devisions', [
            'name' => '',
            'content' => ''
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testCreateUnauthorized()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class]);

        $this->post('/devisions', [
            'name' => 'Programming',
            'content' => 'Content Programming'
        ], [
            'Authorization' => 'salah'
        ])->assertStatus(401);
    }

    public function testUpdateSuccess()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

        $devision = Devision::first();

        $this->put("/devisions/$devision->id", [
            'name' => 'Desain Grafis',
            'content' => 'Content Desain Grafis'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302);
    }

    public function testUpdateInvalid()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

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
        $this->seed([RoleSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

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
        $this->seed([RoleSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

        $this->put("/devisions/1", [
            'name' => 'Desain Grafis',
            'content' => 'Content Desain Grafis'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(404);
    }

    public function testDeleteSuccess()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

        $devision = Devision::first();

        $this->delete("/devisions/$devision->id", headers: [
            'Authorization' => 'admin'
        ])->assertStatus(302);
    }

    public function testDeleteNotFound()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

        $this->delete("/devisions/1", headers: [
            'Authorization' => 'admin'
        ])->assertStatus(404);
    }

    public function testDeleteUnauthorization()
    {
        $this->seed([RoleSeeder::class, AdminSeeder::class, DevisionSeeder::class]);

        $devision = Devision::first();

        $this->delete("/devisions/$devision->id", headers: [
            'Authorization' => 'salah'
        ])->assertStatus(401);
    }
}
