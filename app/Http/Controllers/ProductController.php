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

         if (!Gate::allows('isadmin')) {
            abort(403);
         }

      } else if (is_int(intval($id))) {
         $data = Product::findOrFail($id);
      } 

      return $isJson ? response(json_encode($data, JSON_UNESCAPED_UNICODE), 200)
         : view($view)
         ->with('data', $data);
   }

   public function deleteProduct(Request $request, Product $product)
   {
      if($request->user->cannot("delete",$product)){
         abort(403);
      }else{
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
}
