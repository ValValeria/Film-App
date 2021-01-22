<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller{

    public function vueroute()
    {
        $userCount = User::all()->count();
        return view('vue')->with("count",Product::all()->count())
                           ->with("usersCount",$userCount);
    }
}

?>