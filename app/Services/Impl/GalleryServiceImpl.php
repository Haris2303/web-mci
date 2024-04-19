<?php

namespace App\Services\Impl;

use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryServiceImpl implements GalleryService
{
    public function create(string $image): Gallery
    {
        $gallery = new Gallery();
        $gallery->image = $image;
        $gallery->user_id = Auth::id();
        $gallery->save();

        return $gallery;
    }

    public function delete(int $id): Gallery
    {
        $gallery = Gallery::where('id', $id)->firstOrFail();
        Storage::delete($gallery->image);
        $gallery->delete();

        return $gallery;
    }
}
