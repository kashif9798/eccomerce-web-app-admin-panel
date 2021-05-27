<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EditCategory extends Component
{

    public $editCategory;

    public $products;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($editCategory = false, $products = [])
    {
        $this->editCategory = $editCategory;
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.models.categories.edit-category');
    }
}
