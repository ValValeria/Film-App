<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminArea\AdminController;
use App\Http\Controllers\AdminArea\AdminLoginController;
use App\Http\Controllers\AdminArea\AdminProductController;
use App\Http\Controllers\AdminArea\AdminOrderController;
use App\Http\Controllers\AdminArea\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AddOrderController;



Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function(){
       Route::get('/', [AdminController::class, 'index'])->name('home');
       Route::get('/addproduct', [AdminProductController::class, 'index']);
       Route::post('/addproduct', [AdminProductController::class, 'addProduct']);
       Route::get('/delete/{productId}',[ProductController::class,'deleteProduct'])->whereNumber('id');
       Route::post('/updateproduct/{id}',[AdminProductController::class,'updateProduct'])->whereNumber('id');
       Route::get('/orders',AdminOrderController::class);
    });
    
    Route::get('/login', [AdminLoginController::class, 'index'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);

    Route::get('/users',UsersController::class);

    Route::get('/product/{id}',[ProductController::class,'getProduct'])->whereNumber('id');
    Route::get('/products',[ProductController::class,'getProduct']);
});

Route::middleware(["cors"])->group(function () {
    Route::prefix("api")->group(function () {
        Route::post('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/signup', [AuthController::class, 'index']);
        Route::get('/addorder', [AddOrderController::class, 'addOrder']);
        Route::get('/orderlist/{id}', [AddOrderController::class, 'viewOrders'])->whereNumber('id');
    });
});

Route::get('/{any}', [HomeController::class,'vueroute'])->where('any', '.*');
