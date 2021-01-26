<?php

namespace App\Http\Controllers\AdminArea;

use App\Events\OrderStatusChanged;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminOrderController extends Controller{

    public function __construct()
    {
       $this->middleware("auth");
    }

    public function activeOrders(Request $request)
    {
        $orders = Order::where('status','active')->orderBy('created_at')->get();
        $unactive_orders = Order::where('status', 'unactive')->count();
        return view('admin.pages.allorders')->with("orders",$orders)
                                            ->with('count', $unactive_orders);
    }

    public function unactiveOrders()
    {
        $orders = Order::where('status', 'unactive')->orderBy('created_at')->get();
        $active_orders = Order::where('status','active')->count();
        return view('admin.pages.unactiveorders')->with("orders", $orders)->with('count',$active_orders);
    }

    public function changeOrderStatus(Request $request)
    {
        if($request->user()->cannot('update',Order::class)){
             abort(403);
        } 

        if($request->isMethod('post') && $request->has('orders_id')){
            $ids = $request->input('orders_id');

            $orders = Order::whereIn('id',$ids);
            $orders->update(["status"=>"unactive"]);

            $orders->get()->filter(function($v){
               OrderStatusChanged::dispatch($v);
            });

            return back()->with("status","updated")->with('count_update',count($ids));
        }

        return back();
    }
}
