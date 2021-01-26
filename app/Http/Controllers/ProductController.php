<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{

   const IS_JSON = 'isjson';
   private User $user;

   public function getProduct(Request $request, $id = null)
   {
      $isJson = $request->query(self::IS_JSON);
      $view = 'admin.pages.product';

      if (Str::contains($request->url(), 'products')) {
         $data = Product::paginate(4);
         $view = 'admin.pages.products';
      } else if (is_int(intval($id))) {
         $data = Product::findOrFail($id);
      }

      if ($isJson) {
         return response(json_encode($data, JSON_UNESCAPED_UNICODE), 200);
      } else if (Gate::allows('isadmin')) {
         return view($view)
            ->with('data', $data);
      } else {
         return redirect()->route('login');
      }
   }

   public function deleteProduct(Request $request, Product $product)
   {
      if ($request->user->cannot("delete", $product)) {
         abort(403);
      } else {
         $product->delete();
         return redirect('/admin');
      }
   }

   public function getOrderList(Request $request)
   {
      $this->user = Auth::user();
      $order_list = $this->user->orders();
      return $order_list->toJson();
   }

   public function getIngredients()
   {
      $result = Product::all()->pluck("ingredients");
      $data = [];

      foreach ($result as $value) {
         $arr = json_decode($value,JSON_UNESCAPED_UNICODE);
         $data = array_merge($data,$arr);
      }

      return $data;
   }

   public function getData()
   {
      $data = [
         "ingredients" => $this->getIngredients(),
         "max_price" => Product::all()->max('price'),
         "min_price" => Product::all()->min('price'),
         "max_weight" => Product::all()->max('weight'),
         "min_weight" => Product::all()->max('weight'),
      ];
      return response(json_encode($data,JSON_UNESCAPED_UNICODE))->header('Content-Type','application/json');
   }
}
