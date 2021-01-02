<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\AuthRule;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;


class AdminProductController extends Controller{

    public function index()
    {
        return view('admin.pages.addproduct');
    }

    public function addProduct(Request $request)
    {
        $data = $request->only(['title','short_description',
                               'long_description','image',
                               'price']); 

       $validator = Validator::make($data,[
          'title'=>'bail|required|min:10|max:50',
          'short_description'=>'required|min:10|max:50',
          'long_description'=>'required|min:10|max:200',
          'image'=>'required|file',
          'price' => 'required|numeric',
          'weight'=>'numeric'
       ]);

       if ($validator->fails()) {
            return redirect($request->url())
                        ->withErrors($validator)
                        ->withInput();
       } else{
           $file = $request->file('image');
           $path = Storage::putFileAs('images',
                                       $file,
                                       $file->getClientOriginalName());

           $product = new Product();
           $product->image = $path;
           $product->short_description = $request->short_description;
           $product->long_description = $request->long_description;
           $product->title = $request->title;
           $product->price = $request->price;
           $product->weight = $request->input('weight','400');
           $product->save();

           return redirect($request->path())->with("status",'added');
       }
    }
}
?>