<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller{

    public function __construct()
    {
       $this->middleware("auth");
    }

    public function __invoke(Request $request)
    {
        $orders = Order::where('status','active')->get();
        return view('admin.pages.allorders')->with("orders",$orders);
    }
}
