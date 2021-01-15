<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller{

    public function vueroute()
    {
        return view('vue',["count"=>Product::all()->count()]);
    }
}

?>