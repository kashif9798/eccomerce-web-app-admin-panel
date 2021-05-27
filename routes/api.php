<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CategoryProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api.')
    ->group(function(){
            /*
            |----------------------
            |  Categories Routes
            |---------------------- 
            */
            Route::resource('categories', CategoryController::class)->only([
                'index', 'store', 'update', 'destroy'
            ]);

            /*
            |----------------------
            |  Products BY Categories Routes
            |---------------------- 
            */
            Route::resource('categories.products', CategoryProductController::class)->only([
                'index'
            ]);

            /*
            |----------------------
            |  Products Routes
            |---------------------- 
            */
            Route::resource('products', ProductController::class)->only([
                'index'
            ]);
    });