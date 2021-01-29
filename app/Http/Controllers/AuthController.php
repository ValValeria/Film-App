<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    private bool $isLogin = false;
    private array $data = ["status" => "guest", "errors" => []];
    private ?object $user = null;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->data["status"] = "user";
                $this->data["data"] = Auth::user();
                return response(json_encode($this->data,JSON_UNESCAPED_UNICODE));
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $this->base_index($request);
        return response()->json($this->data);
    }

    public function base_index(Request $request):bool
    {
        $rules = [
            'password' => "required|max:20|min:10",
            'email' => ["required", "max:20", "min:10", "email:rfc,dns"],
            'username' => 'required|min:10|max:30'
        ];

        if ($request->route()->named('api.login')) {
            $this->isLogin = true;
            $rules = Arr::except($rules, ['username']);
        }

        $input = $request->only(['email','password','username']);

        if($request->hasHeader("Auth")){
            $input = json_decode($request->header('Auth'),JSON_UNESCAPED_UNICODE);
        }

        $validator = Validator::make($input, $rules);

        $validator->after(function ($validator) use ($input) {
            if(!count($validator->errors()->all())){
                $this->user = User::where('email', $input['email'])->where('password', $input['password'])->first();

                if (!count($validator->errors())) {
                    if (!$this->user && $this->isLogin) {
                        $validator->errors()->add('email', 'Вас нет в нашей базе данных');
                    } elseif ($this->user && !$this->isLogin) {
                        $validator->errors()->add('email', 'Похоже, вы уже есть в нашей базе данных');
                    }
                }
            }
        });

        if ($validator->fails()) {
            $this->data["errors"] = $validator->errors();
        } else {
            if (!$this->isLogin) {
                $this->user = new  User();
                $this->user->email = $request->input('email', '');
                $this->user->password = $request->input('password', '');
                $this->user->username = $request->input('username', '');
                $this->user->save();
            }

            Auth::login($this->user);
            $this->data["status"] = "user";
            $this->data["data"] = $this->user;
        }
        
        return  $this->data["status"] === "user";
    }
}
