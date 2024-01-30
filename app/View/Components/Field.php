<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Field extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $title;
    public $error;
    public $tag = 'input';
    public $items = false;
    public $value = false;
    public function __construct($items = false, $value = false, $title = false, $error = false, $tag = 'input')
    {
        $this->title = $title;
        $this->error = $error;
        $this->tag = $tag;
        $this->items = $items;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.field');
    }
}
