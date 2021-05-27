<?php

namespace App\Mail;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailProductsCategories extends Mailable
{
    use Queueable, SerializesModels;
    
    public $products;

    public $categories;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($products, $categories)
    {
        $this->products = $products;
        $this->categories = $categories;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.categoriesproducts')->subject('List of all Categories and Products');
    }
}
