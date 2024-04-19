<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectCreateRequest;
use App\Http\Requests\Admin\ProjectUpdateRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{

    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }
    public function store(ProjectCreateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('projects');
        }

        DB::transaction(function () use ($data) {
            $project = $this->projectService->create($data);
            Log::info($project);
        });

        return redirect()->to('/dashboard/projects')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(string $slug, ProjectUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->file('image')) {
            // if image is change
            if ($request->oldImage) {
                Log::info($request->oldImage);
                Storage::delete($request->oldImage);
            }
            $data['image'] = $request->file('image')->store('projects');
        }

        DB::transaction(function () use ($slug, $data) {
            $project = $this->projectService->update($slug, $data);
            Log::info($project);
        });

        return redirect()->to('/dashboard/projects')->with('success', 'Data berhasil diubah');
    }

    public function destroy(string $slug): RedirectResponse
    {
        DB::transaction(function () use ($slug) {
            $project = Project::where('slug', $slug)->firstOrFail();
            if ($project->image) {
                Storage::delete($project->image);
            }
            $this->projectService->delete($slug);
        });

        return redirect()->to('/dashboard/projects')->with('success', 'Data berhasil dihapus');
    }
}
