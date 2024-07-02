<?php

namespace App\Http\Controllers;

use Vonage\Client;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vonage\Client\Credentials\Basic;
use Illuminate\Contracts\Session\Session;

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

    //go to view to show all users and their phone

    public function showUsers(){
        $users=User::all(['phone','name','id']);
        return view('admin.showUsers',['users'=>$users]);
    }


      //send message method
     public function sendMessage($id){

        $user=User::findOrFail($id);
        $phone=$user->phone;
        $userName=$user->name;
        // dd($phone);

    $basic  = new Basic("6d9f76f1", "qGTTjNCSTcBiDNZ8");
    $client = new Client($basic);

    $response = $client->sms()->send(
      new \Vonage\SMS\Message\SMS("$phone", 'E-store', "donn't be afraid  from result it will be Ok ")
  );
  
  $message = $response->current();
  
  if ($message->getStatus() == 0) {
    session()->flash('success',"message sent to $userName");
    //redirect
    return redirect(url("admin/products/all"));
  } else {
      echo "The message failed with status: " . $message->getStatus() . "\n";
  }
  }
    
}
