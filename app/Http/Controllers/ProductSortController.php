<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductSortController extends Controller
{

    public function __invoke(Request $request)
    {
        $product = Product::all();

        if ($request->has('sortBy')) {
            $filter = $request->query('sortBy', []);

            if(gettype($filter)==="string"){
                $filter = array($filter);
            }

            foreach ($filter as  $value) {

                switch ($value) {
                    case 'category':
                        $category = $request->query('category', '');
                        $product = $product->where('category', $category);
                        break;

                    case 'price':
                        $min_price = $request->query('min_price', 0);
                        $max_price = $request->query('max_price',0);
                        $product = $product->whereBetween('price', [intval($min_price),intval($max_price)]);
                        break;

                    case 'weight':
                        $min_weight = $request->query('min_weight','0');
                        $max_weight = $request->query('max_weight', '0');
                        $product = $product->whereBetween('weight',[intval($min_weight), intval($max_weight)]);
                        break;

                    case 'ingredients':
                        $ingredients = $request->query('ingredients',[]);
                        $product = $product->whereJsonContains('ingredients',$ingredients);
                    default:
                        break;
                }
            }
        }

        return json_encode(["data"=>$product], JSON_UNESCAPED_UNICODE);
    }
}
