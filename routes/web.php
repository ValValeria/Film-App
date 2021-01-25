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
use App\Http\Controllers\AdminArea\LogoutController;
use App\Http\Controllers\ProductSortController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth', 'only_admin'])->group(function(){
       Route::get('/', [AdminController::class, 'index'])->name('home');
       Route::get('/addproduct', [AdminProductController::class, 'index']);
       Route::post('/addproduct', [AdminProductController::class, 'addProduct']);
       Route::get('/delete/{productId}',[ProductController::class,'deleteProduct'])->whereNumber('id');
       Route::post('/updateproduct/{id}',[AdminProductController::class,'updateProduct'])->whereNumber('id');
       Route::get('/orders',[AdminOrderController::class, 'activeOrders']);
       Route::get('/unactive-orders', [AdminOrderController::class, 'unactiveOrders']);
       Route::get('/user/{user}', [AddOrderController::class, 'viewOrders']);
       Route::get('/users', UsersController::class);
       Route::get('/logout',LogoutController::class);
       Route::get('/change-order-status/{order}',[AddOrderController::class,'changeOrderStatus']);
    });
    
    Route::get('/login', [AdminLoginController::class, 'index'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);

    Route::get('/product/{id}',[ProductController::class,'getProduct'])->whereNumber('id');
    Route::get('/products',[ProductController::class,'getProduct']);
});

Route::middleware(["cors","json_auth"])->group(function () {
    Route::prefix("api")->group(function () {
        Route::post('/login', [AuthController::class, 'index'])->name('api.login');
        Route::post('/signin', [AuthController::class, 'index'])->name('api.signup');
        Route::get('/addorder', [AddOrderController::class, 'addOrder']);
        Route::get('/view-orders/{user}', [AddOrderController::class, 'viewOrders']);
        Route::get('/product-sort', ProductSortController::class);
    });
});

Route::get('/{any}', [HomeController::class,'vueroute'])->where('any', '.*');
