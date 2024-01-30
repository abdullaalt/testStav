<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Video extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $src;
    public function __construct($src = false)
    {
        $this->src = $src;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.video');
    }
}
