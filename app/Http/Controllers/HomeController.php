<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect(){

        $products=Product::paginate(3);

        if ( Auth::user()->{'user-type'} =="admin") {
           return view("admin.home");
        }else {
            return view("user.home")->with('products',$products );

        }
       
       
       
    }
    public function emailVerify(){
        return view('dashboard');
    }
public function verificationV (){
    return view('auth.login');
}
    public function logout(Request $request)
    {
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/home');
    }
}
