<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return $this->showAll($categories);
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

        return $this->showMessage('The Category was succesfully created', $category);
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
        
        $category->fill($request->only([
            'name',
            'description'
        ]));

        if($category->isClean()){
            
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $category->save();

        if(isset($request->products)){
            $category->products()->sync($request->products);
        }

        return $this->showMessage('The Category was succesfully updated', $category);
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

        return $this->showMessage('The Category was succesfully deleted', $category);
    }
}
