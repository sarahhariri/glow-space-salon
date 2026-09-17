<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Team extends Component
{
    /**
     * Create a new component instance.
     */
    public $team;
    public function __construct($team)
    {
        $this->team = $team;
    }   
   

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.team');
    }
}
