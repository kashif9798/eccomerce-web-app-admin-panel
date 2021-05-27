<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * Authentication Routes
 */
Auth::routes();

/**
 * admin Routes
 */
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role'])
    ->group(function(){
        

        /**
         * Products Routes
         */
        Route::resource('products', ProductController::class)->except([
            'create', 'show'
        ]);

        /**
         * Categories Routes
         */
        Route::resource('categories', CategoryController::class)->except([
            'create', 'show'
        ]);


        /**
         * Email Route
         */
        Route::get('email/{user}', [EmailController::class, 'index'])->name('email');

         /**
         * Payment Routes
         */
        
        Route::get('/payments/{product}/product', [PaymentController::class, 'index'])->name('pay.details');
        Route::post('/payments/pay', [PaymentController::class, 'pay'])->name('pay');
        Route::get('/payments/approval', [PaymentController::class, 'approval'])->name('approval');
        Route::get('/payments/cancelled', [PaymentController::class, 'cancelled'])->name('cancelled');
    });

