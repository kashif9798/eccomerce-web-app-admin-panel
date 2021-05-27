<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EditProduct extends Component
{

    public $editProduct;

    public $categories;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($editProduct = false, $categories = [])
    {
        $this->editProduct  = $editProduct;
        $this->categories   = $categories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.models.products.edit-product');
    }
}
