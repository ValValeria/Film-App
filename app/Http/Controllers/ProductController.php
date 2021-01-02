<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;


class ProductController extends Controller{

    const IS_JSON = 'isjson';

    public function getProduct(Request $request, Product $product)
    {   
        $isJson = $request->query(self::IS_JSON);
        $view = 'admin.pages.product';
        $data = $product;

        if(Str::contains($request->url(),'products')){
           $data = Product::paginate(4);
           $view = 'admin.pages.products';
        } 

        return $isJson ? response()->toJson($data->toJson())
                            :view($view)
                            ->with('data',$data);
    }
}

?>