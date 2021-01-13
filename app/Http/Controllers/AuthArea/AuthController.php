<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller{

   private bool $isLogin = false; 
   private array $data = ["status"=>"guest","errors"=>[]];
   private ?object $user = null;

   public function __construct(){
      $this->middleware(function($request,$next){
         if(Auth::check()){
             return redirect('/');
         } 
         return $next($request);
      });
   } 

   public function __invoke(Request $request){
       $path = $request->path();
       $rules = ['password'=>"required|max:20|min:10",
                  'email'=>["required","max:20","min:10","email:rfc,dns"],
                  'username'=>'required|min:10|max:30'
                ];

       if(!Str::contains("login")){
          $this->isLogin = false;
          $rules = Arr::except($rules,['username']);
       }

       $validator = Validator::make($request->all(),$rules);

       $validator->after(function($validator){
            $this->user = User::where('email',$request->email)->where('password',$request->password);
            
            if(!count($validator->errors())){
                if (!$user->exists() && $this->isLogin){
                    $validator->errors()->add('email','Вас нет в нашей базе данных');
                } elseif ($user->exists() && !$this->isLogin){
                    $validator->errors()->add('email','Похоже, вы уже есть в нашей базе данных');                    
                }
            }
       });

       if($validator->fails()){
           $this->data["errors"] = $validator->errors();
       } else{
           if(!$this->isLogin){
              $this->user = \User::create($request->only(['email','password','username']));
           }
           Auth::login($this->user);
           $this->data["status"] = "user";
       }

       return response()->json($this->data);
   }
}
?>