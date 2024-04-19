<?php

namespace App\Services;

use App\Models\Cooperation;

interface CooperationService
{
    function create(array $data): Cooperation;

    function update(int $id, array $data): Cooperation;

    function delete(int $id): Cooperation;
}
