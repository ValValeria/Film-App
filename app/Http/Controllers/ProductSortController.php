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

            if (gettype($filter) === "string") {
                $filter = array($filter);
            }

            foreach ($filter as  $value) {

                switch ($value) {
                    case "text":
                        $text = $request->query('text', '');
                        $product = Product::query()->where('title', 'like', "%$text%")->get();
                        break;
                        
                    case 'category':
                        $category = $request->query('category', '');
                        $product = $product->where('category', $category);
                        break;

                    case 'price':
                        $min_price = $request->query('min_price', 0);
                        $max_price = $request->query('max_price', 0);
                        $product = $product->whereBetween('price', [intval($min_price), intval($max_price)]);
                        break;

                    case 'weight':
                        $min_weight = $request->query('min_weight', '0');
                        $max_weight = $request->query('max_weight', '0');
                        $product = $product->whereBetween('weight', [intval($min_weight), intval($max_weight)]);
                        break;

                    case 'ingredients':
                        $ingredients = $request->query('ingredients', []);
                        $data = [];

                        foreach ($product as $pr) {
                            $json = $ingredients;
                            $ingr = json_decode($pr->ingredients, JSON_UNESCAPED_SLASHES)??[];

                            if (count(array_intersect($json, $ingr))) {
                                array_push($data, $pr);
                            }
                        }
                        $product = collect($data);
                    default:
                        break;
                }
            }
        }

        return response(json_encode(["data" => $product], JSON_UNESCAPED_UNICODE), 200)->header('Content-Type', 'application/json');
    }
}
