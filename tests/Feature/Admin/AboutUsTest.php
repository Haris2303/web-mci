<?php

namespace Tests\Feature\Admin;

use Database\Seeders\AboutUsSeeder;
use Database\Seeders\AdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AboutUsTest extends TestCase
{
    public function testUpsertSuccess()
    {
        $this->seed(AdminSeeder::class);

        $this->patch('/about_us', [
            'content' => 'Ini adalah about'
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testUpsertInvalid()
    {
        $this->seed(AdminSeeder::class);

        $this->patch('/about_us', [
            'content' => ''
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testUpsertUnauthorized()
    {
        $this->seed(AdminSeeder::class);

        $this->patch('/about_us', [
            'content' => 'Ini adalah about'
        ], [
            'Authorization' => 'salah'
        ])->assertStatus(401)->assertSessionHasNoErrors();
    }

    public function testUpserSuccessForUpdate()
    {
        $this->seed([AdminSeeder::class, AboutUsSeeder::class]);

        $this->patch('/about_us', [
            'content' => 'Ini adalah about baru'
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }
}
