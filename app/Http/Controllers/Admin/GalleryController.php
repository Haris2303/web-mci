<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{

    private GalleryService $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }

    public function store(GalleryRequest $request): RedirectResponse
    {
        // check permission
        Gate::authorize('create', Gallery::class);

        $credentials = $request->validated();

        if ($request->file('image')) {
            $credentials['image'] = $request->file('image')->store('galleries');
        }

        DB::transaction(function () use ($credentials) {
            $gallery = $this->galleryService->create($credentials['image']);
            Log::info($gallery);
        });

        return redirect()->to('/dashboard/galleries')->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy(int $id): RedirectResponse
    {
        // check permission
        $gallery = Gallery::where('id', $id)->firstOrFail();
        Gate::authorize('delete', $gallery);

        DB::transaction(function () use ($id) {
            $gallery = $this->galleryService->delete($id);
            Log::info($gallery);
        });

        return redirect()->to('/dashboard/galleries')->with('success', 'Data berhasil dihapus');
    }
}
