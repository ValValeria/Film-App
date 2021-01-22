<?php

namespace  App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;


class AddOrderController extends Controller
{
    private array $response = ["data" => [], "status" => "", "errors" => []];

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function addOrder(Request $request)
    {
        //$user = $request->user();
        $user = User::find(2);
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
                    $order->save();
                } else {
                    $user->orders()->create([
                        "product_id" => $product->id,
                        "quantity" => $quantity,
                        "user_id" => $user->id,
                        "status" => "active"
                    ]);
                }
                $this->response["data"] = "added";
                $user->refresh();
            }

            return $this->response;
        }
    }

    public function viewOrders(Request $request,int $id)
    {
       $user = User::findOrFail($id);
       $user->orders->load('product');

       if($request->isjson){
           return json_encode($user, JSON_UNESCAPED_UNICODE);
       }

       return view('admin.pages.userorders');
    }
}
