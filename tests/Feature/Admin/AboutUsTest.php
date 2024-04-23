<?php

namespace Tests\Feature\Admin;

use App\Models\AboutUs;
use Database\Seeders\AboutUsSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AboutUsTest extends TestCase
{
    public function testUpsertSuccess()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->patch('/about_us', [
            'content' => 'Ini adalah about'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasNoErrors();

        $aboutUs = AboutUs::first();
        $this->assertEquals($aboutUs->content, 'Ini adalah about');
    }

    public function testUpsertInvalid()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->patch('/about_us', [
            'content' => ''
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testUpsertUnauthorized()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        $this->patch('/about_us', [
            'content' => 'Ini adalah about'
        ], [
            'Authorization' => 'salah'
        ])->assertStatus(401)->assertSessionHasNoErrors();
    }

    public function testUpserSuccessForUpdate()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, AboutUsSeeder::class]);

        $this->patch('/about_us', [
            'content' => 'Ini adalah about baru'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasNoErrors();

        $aboutUs = AboutUs::first();
        $this->assertEquals($aboutUs->content, 'Ini adalah about baru');
    }
}
