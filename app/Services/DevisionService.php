<?php

namespace App\Services;

use App\Models\Devision;

interface DevisionService
{
    function create(array $data): Devision;

    function update(int $id, array $data): Devision;

    function delete(int $id): Devision;
}
