<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\AuthRule;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

trait Validate{

   public function validateData(Request $request, $callback, $url="",$imageNeed=true)
    {
       $data = $request->only(['title','short_description',
                               'long_description','image',
                               'price']); 

       $validator = Validator::make($data,[
          'title'=>'bail|required|min:10|max:50',
          'short_description'=>'required|min:10|max:50',
          'long_description'=>'required|min:10|max:200',
          'image'=> !$imageNeed?'image':'required|image',
          'price' => 'required|numeric',
          'weight'=>'numeric'
       ]);

       if ($validator->fails()) {
            return redirect($url?$url:$request->path())
                        ->withErrors($validator)
                        ->withInput();
       } else{
           if(is_callable($callback)){
            return $callback();
           }
       }
    }
}

class AdminProductController extends Controller{

    use Validate;

    public function index()
    {
        return view('admin.pages.addproduct');
    }

    public function updateProduct(Request $request, int $id)
    {
       $url = '/admin/product/'.$id; 

       $response = $this->validateData($request, function() use($request,$id){
           $data = $request->all();

           if ($request->hasFile('image')) {
               $file = $request->file('image');
               $data['image'] = Storage::disk('public')->putFileAs('images', $file, $file->getClientOriginalName());
           } else{
               unset($data['image']);
           }

           Product::updateOrCreate(["id"=> $id],$data);
           
           return redirect('/admin/product/'.$id)->with("status",'updated');
       }, $url,false);

       return $response;
    }

    public function addProduct(Request $request)
    {
       $response = $this->validateData($request, function(){
           $file = $request->file('image');
           $path = Storage::disk('public')->putFileAs('images',
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
       });

       return $response;
    }
}
?>