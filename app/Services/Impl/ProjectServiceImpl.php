<?php

namespace App\Services\Impl;

use App\Http\Requests\Admin\ProjectCreateRequest;
use App\Http\Requests\Admin\ProjectUpdateRequest;
use App\Services\ProjectService;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectServiceImpl implements ProjectService
{
    public function create(array $data): Project
    {
        // Implementasi untuk membuat project baru
        $project = new Project();
        $project->image = $data['image'] ?? null;
        $project->slug = Str::slug($data['title']);
        $project->title = $data['title'];
        $project->description = $data['description'];
        $project->type = $data['type'];
        $project->user_id = Auth::id();
        $project->save();

        return $project;
    }

    public function update(string $slug, array $data): Project
    {
        $project = Project::where('slug', $slug)->where('user_id', Auth::id())->firstOrFail();
        $project->fill($data);
        $project->save();

        return $project;
    }

    public function delete($slug): Project
    {
        // Implementasi untuk menghapus project berdasarkan ID
        $project = Project::where('slug', $slug)->firstOrFail();
        $project->delete();

        return $project;
    }

    // Tambahkan metode lain yang diperlukan
}
