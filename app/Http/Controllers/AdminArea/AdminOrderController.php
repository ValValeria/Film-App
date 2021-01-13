<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Order;


class AdminOrderController extends Controller{

    public function __construct()
    {
       $this->middleware("auth");
    }

    public function __invoke()
    {
        $orders = Order::all();
        return view('admin.pages.orders')->with("orders",$orders);
    }
}
