<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class DashboardLayout extends Component
{

    public function __construct(public string $title = 'Dashboard')
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('layouts.dashboard');
    }
}
