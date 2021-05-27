<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        $products   = Product::all();

        return view('admin.categories.index', ['categories' => $categories, 'products' => $products]);
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
            'description' => ['required']
        ];

        $this->validate($request,$rules);

        $data = $request->all();

        $category = Category::create($data);

        if(isset($data['products'])){
            $category->products()->sync($data['products']);
        }

        $request->session()->flash('category-create-message','The Category ' . $category->name .' was created Successfully');

        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editCategory = Category::findOrFail($id);

        $categories = Category::all();

        $products = Product::all();

        return view('admin.categories.index', ['editCategory' => $editCategory, 'categories' => $categories, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $rules = [
            'name' => ['required'],
            'description' => ['required']
        ];

        $this->validate($request,$rules);

        $category->fill($request->only([
            'name',
            'description'
        ]));

        $category->save();

        if(isset($request->products)){
            $category->products()->sync($request->products);
        }

        $request->session()->flash('category-update-message','The Category ' . $category->name .' was updated Successfully');

        return redirect()->route('admin.categories.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->products()->detach();

        $category->delete();

        session()->flash('category-delete-message','The Category ' . $category->name .' was deleted');

        return redirect()->route('admin.categories.index');
    }
}
