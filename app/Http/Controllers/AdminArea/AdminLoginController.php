<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminLoginController extends Controller{

    public function index()
    {
        return view('admin.pages.login');
    }

    public function login(Request $request)
    {          
       $password = $request->input('password','');

       $validator = Validator::make($request->all(),[
        'email' => ['bail','required','email','max:40','min:10'],
        'password' => 'required|max:20|min:5',
       ]);

       if($validator->fails()){
            return redirect()->route('login')
                        ->withErrors($validator)
                        ->withInput();
       } else{
           $user = User::where('email',$request->email)
                        ->where('password',$request->password)
                        ->first();

           if($user){
               Auth::login($user);
               return redirect('/admin');
           } else{
               $validator->errors()->add("email","It seems that you are not the admin");
               return redirect()->route('login')
                        ->withErrors($validator)
                        ->withInput();
            }
       }
    }
}
?>