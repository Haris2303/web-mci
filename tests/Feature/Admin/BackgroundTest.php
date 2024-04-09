<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Database\Seeders\AdminSeeder;
use Database\Seeders\BackgroundSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class BackgroundTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSuccess(): void
    {
        $this->seed([AdminSeeder::class, BackgroundSeeder::class]);

        $response = $this->put('/background', [
            'content' => 'Ini latar belakang',
        ], [
            "Authorization" => "token123"
        ]);

        Log::info(json_encode($response, JSON_PRETTY_PRINT));

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
    }

    public function testUpdateUnauthorized(): void
    {
        $this->seed(AdminSeeder::class);

        $response = $this->put('/background', [
            'content' => 'Ini latar belakang',
        ], [
            "Authorization" => "salah"
        ]);

        Log::info(json_encode($response, JSON_PRETTY_PRINT));

        $response->assertStatus(401);
        $response->assertSessionHasNoErrors();
    }

    public function testUpdateRequestInvalid(): void
    {
        $this->seed(AdminSeeder::class);

        $response = $this->put('/background', [
            'content' => '',
        ], [
            "Authorization" => "token123"
        ]);

        Log::info(json_encode($response, JSON_PRETTY_PRINT));

        $response->assertStatus(302);
        $response->assertSessionHasErrors();
    }
}
