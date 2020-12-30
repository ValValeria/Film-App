<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\AuthRule;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

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
          'long_description'=>'required|min:10|max:50',
          'image'=>'required|image',
          'long_description'=>'required|min:10|max:50',
          'price' => 'required'
       ]);

       if ($validator->fails()) {
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
       } else{
           $file = $request->file('photo');
           $path = Storage::putFileAs('images',
                                       $file,
                                       $file->getClientOriginalName());
           $product = Product::create($data);
           return redirect($request->path())->with("status",'added');
       }
    }
}
?>