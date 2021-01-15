<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Product;

class AdminController extends Controller{

    public function __construct()
    {
    
    }

    public function index()
    {
        return view('admin.pages.home')->with('count',Product::all()->count());
    }
}
?>