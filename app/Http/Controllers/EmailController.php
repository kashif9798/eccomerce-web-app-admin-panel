<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailProductsCategories;

class EmailController extends Controller
{
    public function index(User $user)
    {
        $products = Product::all();

        $categories = Category::all();

        retry(5, function () use ($user, $products, $categories) {

            Mail::to($user)->send(new EmailProductsCategories($products, $categories));

        }, 100);

        session()->flash('email-sent-success','The email was sent successfully');

        return redirect()->route('admin');
    }
}
