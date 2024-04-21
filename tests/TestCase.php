<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('DELETE FROM background');
        DB::delete('DELETE FROM vision_misions');
        DB::delete('DELETE FROM projects');
        DB::delete('DELETE FROM devisions');
        DB::delete('DELETE FROM leadership_structures');
        DB::delete('DELETE FROM galleries');
        DB::delete('DELETE FROM about_us');
        DB::delete('DELETE FROM cooperations');
        DB::delete('DELETE FROM user_roles');
        DB::delete('DELETE FROM users');
        DB::delete('DELETE FROM roles');
    }
}
