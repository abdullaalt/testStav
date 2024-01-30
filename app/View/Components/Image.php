<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Image extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $url = false;
    public $src = false;
    public $title = false;

    public function __construct($url = false, $title = false, $src = false)
    {
        $this->url = $url;
        $this->title = $title;
        $this->src = $src;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.image');
    }
}
