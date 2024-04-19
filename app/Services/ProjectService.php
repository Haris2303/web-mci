<?php

namespace App\Services;

use App\Http\Requests\Admin\ProjectCreateRequest;
use App\Http\Requests\Admin\ProjectUpdateRequest;
use App\Models\Project;

interface ProjectService
{
    function create(array $data): Project;

    function update(string $slug, array $data): Project;

    function delete(string $slug): Project;
}
