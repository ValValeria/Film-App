<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;

class Login extends Controller{

    public $status = "user";

    public function __invoke(Request $request){
        $rules = ['password'=>"required|max:20|min:10",
                  'email'=>["required","max:20","min:10","email:rfc,dns"]];

        $validator=$request->validate($rules);
        
        $validator->after(function($validator){
            $user = User::where('email',$request->email)->where('password',$request->password);
            
            if(!$user->exists()){
               $validator->errors()->add('email','Вас нет в нашей базе данных');
            } else{
                $this->status="user";
               Auth::login($user->first());
            }
        });

        return response()->json(["status"=>$this->status,"errors"->$validator->errors()]);
    }
}