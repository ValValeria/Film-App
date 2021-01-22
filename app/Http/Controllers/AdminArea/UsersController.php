<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        $users = User::where('status', '!=', 'admin')->paginate(15);
        
        if($request->has('onlyusers')){
            $users = User::has('orders')->paginate(15);
        }

        return view("admin.pages.users")->with('users', $users);
    }
}
