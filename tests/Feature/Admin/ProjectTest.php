<?php

namespace Tests\Feature\Admin;

use App\Models\Project;
use Database\Seeders\AdminSeeder;
use Database\Seeders\ProjectSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function testCreateSuccess()
    {
        $this->seed(AdminSeeder::class);

        Storage::fake('project');

        $file = UploadedFile::fake()->image('project.jpg');

        $this->post('/projects', [
            'image' => $file,
            'title' => 'Judul Project UKM',
            'slug' => 'judul-project-ukm',
            'description' => 'Deskripsi project',
            'type' => 'UKM'
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testCreateInvalid()
    {
        $this->seed(AdminSeeder::class);

        Storage::fake('project');

        $file = UploadedFile::fake()->image('project.jpg');

        $this->post('/projects', [
            'image' => $file,
            'title' => '',
            'description' => '',
            'type' => 'UKM'
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testCreateUnauthorized()
    {
        $this->seed(AdminSeeder::class);

        Storage::fake('project');
        $file = UploadedFile::fake()->image('project.jpg');

        $this->post('/projects', [
            'image' => $file,
            'title' => '',
            'description' => '',
            'type' => 'UKM'
        ])->assertStatus(401);
    }

    public function testCreateSlugIsExists()
    {
        $this->seed([AdminSeeder::class, ProjectSeeder::class]);

        Storage::fake('project');

        $file = UploadedFile::fake()->image('project.jpg');

        $this->post('/projects', [
            'image' => $file,
            'title' => 'Judul Test',
            'slug' => 'judul-test',
            'description' => 'Deskripsi project',
            'type' => 'UKM'
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testUpdateSuccess()
    {
        $this->seed([AdminSeeder::class, ProjectSeeder::class]);

        $project = Project::where('slug', 'judul-test')->firstOrFail();

        Log::info($project->image);

        Storage::fake('project-baru');
        $file = UploadedFile::fake()->image('project-baru.jpg');

        $this->put("/projects/$project->slug", [
            'image' => $file,
            'title' => 'Judul Project UKM Baru',
            'description' => 'Deskripsi project Baru',
            'oldImage' => $project->image
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testUpdateInvalid()
    {
        $this->seed([AdminSeeder::class, ProjectSeeder::class]);

        $project = Project::where('slug', 'judul-test')->firstOrFail();

        Log::info($project->image);

        $this->put("/projects/$project->slug", [
            'title' => '',
            'description' => '',
            'oldImage' => $project->image
        ], [
            'Authorization' => 'token123'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testUpdateNotFound()
    {
        $this->seed([AdminSeeder::class, ProjectSeeder::class]);

        $project = Project::where('slug', 'judul-test')->firstOrFail();

        $this->put("/projects/$project->slug", [
            'title' => 'judul baru',
            'description' => 'deskripsi baru',
            'oldImage' => $project->image
        ], [
            'Authorization' => 'admin2'
        ])->assertStatus(404);
    }

    public function testDeleteSuccess()
    {
        $this->seed([AdminSeeder::class, ProjectSeeder::class]);

        $project = Project::where('slug', 'judul-test')->firstOrFail();

        $this->delete("/projects/$project->slug", headers: [
            'Authorization' => 'admin2'
        ])->assertStatus(302);
    }

    public function testDeleteNotFound()
    {
        $this->seed([AdminSeeder::class, ProjectSeeder::class]);

        $this->delete("/projects/salah", headers: [
            'Authorization' => 'admin2'
        ])->assertStatus(404);
    }

    public function testDeleteUnauthorized()
    {
        $this->seed([AdminSeeder::class, ProjectSeeder::class]);

        $project = Project::where('slug', 'judul-test')->firstOrFail();

        $this->delete("/projects/$project->slug", headers: [
            'Authorization' => 'admin'
        ])->assertStatus(401);
    }
}
