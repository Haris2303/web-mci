<?php

namespace App\Services;

use App\Models\Gallery;

interface GalleryService
{
    function create(string $image): Gallery;

    function delete(int $id): Gallery;
}
