<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class Signup extends Controller{

    public function __invoke(){
       $rules = ['password'=>"required|max:20|min:10",
                 'email'=>["required","max:20","min:10","email:rfc,dns"],
                 'username'=>'required|min:10|max:30'];

        $validator=$request->validate($rules);
        
        $validator->after(function($validator){
            $user = User::where('email',$request->email)->where('password',$request->password);
            
            if($user->exists()){
               $validator->errors()->add('email','Похоже, вы в нашей базе');
            } else{
                $this->status="user";
               Auth::login($user->first());
            }
        });

        return response()->json(["status"=>$this->status,"errors"->$validator->errors()]); 
    }
}