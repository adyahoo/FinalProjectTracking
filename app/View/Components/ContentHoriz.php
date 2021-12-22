<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ContentHoriz extends Component
{
    public $blogs;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($blogs)
    {
        $this->blogs = $blogs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.content-horiz');
    }
}
