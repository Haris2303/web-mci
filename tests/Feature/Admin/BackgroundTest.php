<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Database\Seeders\AdminSeeder;
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
        $this->seed(AdminSeeder::class);

        $user = User::where('email', 'admin@example.com')->first();

        Auth::login($user);

        $response = $this->post('/background', [
            'content' => 'Ini latar belakang',
            'user_id' => $user->id
        ]);

        Log::info(json_encode($response, JSON_PRETTY_PRINT));

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
    }
}
