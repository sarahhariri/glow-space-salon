<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Carousel extends Component
{
    public $slides;
    /**
     * Create a new component instance.
     */
    public function __construct($slides)
    {
        $this->slides = $slides;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.carousel');
    }
}
