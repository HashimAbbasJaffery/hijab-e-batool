<?php

namespace App\View\Components\front;

use Illuminate\View\Component;

class Product extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public object $product)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.product');
    }
}
