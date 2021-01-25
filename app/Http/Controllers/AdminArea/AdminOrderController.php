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

    public function activeOrders(Request $request)
    {
        $orders = Order::where('status','active')->orderBy('date')->get();
        return view('admin.pages.allorders')->with("orders",$orders);
    }

    public function unactiveOrders(Request $request)
    {
        $orders = Order::where('status', 'unactive')->orderBy('date')->get();
        return view('admin.pages.unactiveorders')->with("orders", $orders);
    }
}
