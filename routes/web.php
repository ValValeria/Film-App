<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminArea\AdminController;
use App\Http\Controllers\AdminArea\AdminLoginController;


Route::get('/products',[ProductController::class,'index']);

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->middleware('admin')->name('home');
    Route::get('/login', [AdminLoginController::class, 'index'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
});

Route::get('/{any}', [HomeController::class,'vueroute'])->where('any', '.*');

?>