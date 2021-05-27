<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CreateProducts extends Component
{
    
    public $categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categories = [])
    {
        $this->categories = $categories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.models.products.create-products');
    }
}
