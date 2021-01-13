<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Order;


class ProductController extends Controller
{

   const IS_JSON = 'isjson';

   public function getProduct(Request $request, $id = null)
   {
      $isJson = $request->query(self::IS_JSON);
      $view = 'admin.pages.product';

      if (Str::contains($request->url(), 'products')) {
         $data = Product::paginate(4);
         $view = 'admin.pages.products';
      } else if (is_int(intval($id))) {
         $data = Product::findOrFail($id);
      } else {
         return redirect('/admin');
      }

      return $isJson ? response(json_encode($data, JSON_UNESCAPED_UNICODE), 200)
         : view($view)
         ->with('data', $data);
   }

   public function deleteProduct(Request $request, Product $product)
   {
      $product->delete();
      return redirect('/admin');
   }

   public function addOrder(Request $request, Product $productId, int $quantity)
   {
      $all_orders = $request->user()->orders();
      $orders = $all_orders->where('product_id', $productId->id);
      $data = ["product_id" => $productId->id, "quantity" => $quantity];

      if ($orders->doesntExist()) {
         $all_orders->create($data);
      } else {
         $order = $orders->first();
         $order->quantity = $quantity;
         $order->save();
      }

      return response()->json(["status" => "added"]);
   }
}
