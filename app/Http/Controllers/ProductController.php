<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        $categories = Category::all();

        return view('admin.products.index', ['products' => $products, 'categories' =>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'categories' => ['required'],
            'img_1'      => ['required', 'image'],
            'img_2'      => ['required', 'image'],
            'img_3'      => ['required', 'image'],
        ];

        $this->validate($request,$rules);

        $data = $request->all();

        $data['img_1']      = $request->file('img_1')->store('');
        $data['img_2']      = $request->file('img_2')->store('');
        $data['img_3']      = $request->file('img_3')->store('');

        $product = Product::create($data);

        $product->categories()->sync($data['categories']);

        $request->session()->flash('product-create-message','The Product ' . $product->name .' was created Successfully');

        return redirect()->route('admin.products.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editProduct = Product::findOrFail($id);

        $products = Product::all();

        $categories = Category::all();

        return view('admin.products.index', ['editProduct' => $editProduct, 'products' => $products, 'categories' =>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'categories' => ['required'],
            'img_1'      => ['required', 'image'],
            'img_2'      => ['required', 'image'],
            'img_3'      => ['required', 'image'],
        ];

        $this->validate($request,$rules);

        $product->img_1      = $request->file('img_1')->store('');
        $product->img_2      = $request->file('img_2')->store('');
        $product->img_3      = $request->file('img_3')->store('');

        $product->fill($request->only([
            'name',
            'price'
        ]));

        $product->save();

        $product->categories()->sync($request->categories);

        $request->session()->flash('product-update-message','The Product ' . $product->name .' was updated Successfully');

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->categories()->detach();

        $product->delete();

        session()->flash('product-delete-message','The Product ' . $product->name .' was deleted');

        return redirect()->route('admin.products.index');
    }
}
