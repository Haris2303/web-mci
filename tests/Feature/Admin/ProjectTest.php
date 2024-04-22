<?php

namespace Tests\Feature\Admin;

use App\Models\Project;
use Database\Seeders\AdminSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\RoleSeeder;
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
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        Storage::fake('project');

        $file = UploadedFile::fake()->image('project.jpg');

        $this->post('/projects', [
            'image' => $file,
            'title' => 'Judul Project UKM',
            'slug' => 'judul-project-ukm',
            'description' => 'Deskripsi project',
            'type' => 'UKM'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testCreateInvalid()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

        Storage::fake('project');

        $file = UploadedFile::fake()->image('project.jpg');

        $this->post('/projects', [
            'image' => $file,
            'title' => '',
            'description' => '',
            'type' => 'UKM'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testCreateUnauthorized()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class]);

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
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, ProjectSeeder::class]);

        Storage::fake('project');

        $file = UploadedFile::fake()->image('project.jpg');

        $this->post('/projects', [
            'image' => $file,
            'title' => 'Judul Test',
            'slug' => 'judul-test',
            'description' => 'Deskripsi project',
            'type' => 'UKM'
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testUpdateSuccess()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, ProjectSeeder::class]);

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
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testUpdateInvalid()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, ProjectSeeder::class]);

        $project = Project::where('slug', 'judul-test')->firstOrFail();

        Log::info($project->image);

        $this->put("/projects/$project->slug", [
            'title' => '',
            'description' => '',
            'oldImage' => $project->image
        ], [
            'Authorization' => 'admin'
        ])->assertStatus(302)->assertSessionHasErrors();
    }

    public function testUpdateNotFound()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, ProjectSeeder::class]);

        $project = Project::where('slug', 'judul-test')->firstOrFail();

        $this->put("/projects/salah", [
            'title' => 'judul baru',
            'description' => 'deskripsi baru',
            'oldImage' => $project->image
        ], [
            'Authorization' => 'admin2'
        ])->assertStatus(404);
    }

    public function testDeleteSuccess()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, ProjectSeeder::class]);

        $project = Project::where('slug', 'judul-test')->firstOrFail();

        $this->delete("/projects/$project->slug", headers: [
            'Authorization' => 'admin'
        ])->assertStatus(302);
    }

    public function testDeleteNotFound()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, ProjectSeeder::class]);

        $this->delete("/projects/salah", headers: [
            'Authorization' => 'admin2'
        ])->assertStatus(404);
    }

    public function testDeleteUnauthorized()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class, AdminSeeder::class, ProjectSeeder::class]);

        $project = Project::where('slug', 'judul-test')->firstOrFail();

        $this->delete("/projects/$project->slug", headers: [
            'Authorization' => 'salah'
        ])->assertStatus(401);
    }
}
