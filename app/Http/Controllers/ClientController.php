<?php

namespace App\Http\Controllers;

use Vonage\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vonage\Client\Credentials\Basic;

class ClientController extends Controller
{
  public function all()
  {
    $products = Product::paginate(3);
    return view('user.home', compact('products'));
  }
  //show
  public function show($id)
  {
    $product = Product::findOrFail($id);
    // dd($product);
    return view("user.show")->with('product', $product);
  }

  //search
  public function search(Request $request)
  {
    $key = $request->search;
    $products = Product::where('name', 'like', "%$key%")->paginate(3);
    return view('user.home', compact('products'));
  }


//addToCart



public function addToCart($id,Request $request){
  $product=Product::findOrFail($id);
  $qty=$request->input('qty');

  $data = $request->validate([
    'qty' => 'required|numeric|min:1|max:5'
]);
  $cart=session()->get('cart');

  if(!$cart){

    $cart=[

      $id=>[
        'name'=>$product->name,
        'price'=>$product->price,
        'image'=>$product->image,
        'qty'=>$qty,
      ],
    ];
    session()->put('cart',$cart);
    // dd(session()->get('cart'));
    return redirect()->back()->with('success','first cart is add');
  }else{

    if(isset($cart[$id])){
      $cart[$id]['qty']=$qty;
      session()->put('cart',$cart);
      return redirect()->back()->with('success','cart updated successfully');


    }

    $cart[$id]=[
      'name'=>$product->name,
        'price'=>$product->price,
        'image'=>$product->image,
        'qty'=>$qty,
    ];
    session()->put('cart',$cart);
     return redirect()->back()->with('success','cart added successfully');

  
  }
  // dd($cart);


}



  public function clearCart()
  {
    // Remove the cart from the session
    session()->forget('cart');

    // Optionally, return a response (e.g., JSON response for AJAX requests)
    return redirect()->back();
  }

  public function myCart(){

    //go to mycart page with product he choose 
    $user_id=Auth::user()->id;
    $products=session()->get('cart');
    // dd($products);
    return view('user.myCart',compact('user_id','products'));
  }

  public function OrderAllCart( Request $request){

    //create in the database in both tables orders and order_details
    $user_id=Auth::user()->id;
    $dayAll=$request->input('dayAll');
    $dayOne=$request->input('dayOne');
    $products=session()->get('cart');

  //validate inputs
  $request->validate([
    'dayAll'=>'required'
  ]);
    // dd($day);
   $order=Order::create([

      'user_id'=>$user_id,
      'required_date'=>$dayAll,
    ]);

    //orderDetails
    //insert order_id|product_id|$quantity|price
    foreach ($products as $id => $product) {

      OrderDetails::create([
        'order_id'=>$order->id,
        'product_id'=>$id,
        'price'=>$product['price'],
        'qty'=>$product['qty'],
        ]);
      }
    
      return redirect(url('home'))->with('success','order made successfully');
  }
  public function orderONe( Request $request){

    //create in the database in both tables orders and order_details
    $user_id=Auth::user()->id;
    $dayOne=$request->input('dayOne');
    $products=session()->get('cart');

  //validate inputs
  $request->validate([
    'dayOne'=>'required'
  ]);
    // dd($day);
   $order=Order::create([

      'user_id'=>$user_id,
      'required_date'=>$dayOne,
    ]);

    //orderDetails
    //insert order_id|product_id|$quantity|price
    foreach ($products as $id => $product) {

      OrderDetails::create([
        'order_id'=>$order->id,
        'product_id'=>$id,
        'price'=>$product['price'],
        'qty'=>$product['qty'],
        ]);
      }
    
      return redirect(url('home'))->with('success','order made successfully');
  }



}
// 
