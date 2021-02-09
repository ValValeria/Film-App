<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller{

    public function index()
    {
        return view('admin.pages.home')->with('user_count',User::where('status','user')->count())->with('product_count', Product::all()->count());
    }
}
?>