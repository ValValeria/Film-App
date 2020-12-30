<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\AuthRule;

class AdminLoginController extends Controller{

    public function index()
    {
        return view('admin.pages.login');
    }

    public function login(Request $request)
    {
       $validated = $request->validate([
        'email' => ['bail','required','email','max:40','min:10', new AuthRule],
        'password' => 'required|max:20|min:10',
       ]);

       return redirect('/admin');
    }
}
?>