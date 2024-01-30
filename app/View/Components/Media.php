<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Media extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $file = false;

    public function __construct($file = false)
    {
        $this->file = $file;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.media');
    }
}
