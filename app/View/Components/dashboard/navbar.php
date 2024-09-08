<?php

namespace App\View\Components\dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class navbar extends Component
{
    public $items;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = config('navbar');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.navbar');
    }
}
