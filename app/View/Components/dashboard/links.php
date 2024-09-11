<?php

namespace App\View\Components\dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class links extends Component
{
    public $items;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = config('links');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.links');
    }
}
