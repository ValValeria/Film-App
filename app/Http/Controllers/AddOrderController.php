<?php

namespace  App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AddOrderController extends Controller
{
    private array $response = ["data" => [], "status" => "", "errors" => []];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addOrder(Request $request)
    {
        $user = $request->user();
        $id = intval($request->input('productId', 0));
        $quantity = intval($request->input('quantity'));

        if ($request->has(['productId', 'quantity']) && is_int($id) && is_int($quantity)) {
            $product = Product::where('id', $id);

            if ($product->exists()) {
                $order = $user->orders()->where('product_id', $id);
                $product = $product->first();

                if ($order->exists()) {
                    $order = $order->first();
                    $order->quantity = $quantity;
                    $order->status = "active";
                    $order->save();
                } else {
                    $user->orders()->create([
                        "product_id" => $product->id,
                        "quantity" => $quantity,
                        "user_id" => $user->id,
                        "created_at" => date('Y-m-d'),
                        "location"=>$request->input('location','')
                    ]);
                }
                $this->response["status"] = "ok";
                $user->refresh();
            }

            return $this->response;
        }
    }

    public function viewOrders(Request $request, User $user)
    {
        Gate::authorize("isadmin");

        $orders = $user->orders;
        $orders->load('product');

        if ($request->isjson) {
            $this->response["data"] = $orders;
            return json_encode($this->response, JSON_UNESCAPED_UNICODE, JSON_UNESCAPED_SLASHES);
        }

        return view('admin.pages.userorders')->with('user', $user);
    }
}
