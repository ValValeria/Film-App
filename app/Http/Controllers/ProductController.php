<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;


class ProductController extends Controller{

    const IS_JSON = 'isjson';

    public function getProduct(Request $request, $id = null)
    {   
        $isJson = $request->query(self::IS_JSON);
        $view = 'admin.pages.product';

        if(Str::contains($request->url(),'products')){
           $data = Product::paginate(4);
           $view = 'admin.pages.products';
        } else if(is_int(intval($id))){
           $data = Product::findOrFail($id);
        } else{
           return redirect('/admin');
        }

        return $isJson ? response(json_encode($data,JSON_UNESCAPED_UNICODE),200)
                            :view($view)
                            ->with('data',$data);
    }

    public function deleteProduct(Request $request, Product $product)
    {
        $product->delete();
        return redirect('/admin');
    }
}

?>