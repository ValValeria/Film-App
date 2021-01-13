<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminArea\AdminController;
use App\Http\Controllers\AdminArea\AdminLoginController;
use App\Http\Controllers\AdminArea\AdminProductController;
use App\Http\Controllers\AuthArea\AuthController;


Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function(){
       Route::get('/', [AdminController::class, 'index'])->name('home');
       Route::get('/addproduct', [AdminProductController::class, 'index']);
       Route::post('/addproduct', [AdminProductController::class, 'addProduct']);
       Route::get('/delete/{productId}',[ProductController::class,'deleteProduct'])->whereNumber('id');
       Route::post('/updateproduct/{id}',[AdminProductController::class,'updateProduct'])->whereNumber('id');
    });
    
    Route::get('/login', [AdminLoginController::class, 'index'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);

    Route::get('/product/{id}',[ProductController::class,'getProduct'])->whereNumber('id');
    Route::get('/products',[ProductController::class,'getProduct']);
});

Route::get('/{any}', [HomeController::class,'vueroute'])->where('any', '.*');

Route::prefix("api")->group(function(){
    Route::post('/login', AuthController::class);
    Route::post('/signup', AuthController::class);
    Route::get('/addorder/{productId}/{quantity}', [ProductController::class,'addOrder'])->whereNumber("quantity")->whereNumber("productId")->middleware('auth');
});
