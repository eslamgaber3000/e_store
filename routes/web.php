<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Models\Product;

Route::get('/', function () {
    $products=Product::paginate(3);
    return view('user.home',compact('products'));
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('verification/verify',[]);

Route::controller(HomeController::class)->group(function(){

    Route::get('verification/verify','verificationV')->name('verification.verify');
});
Route::get('email/verify', [HomeController::class,'emailVerify'])->name('verification.notice');


//redirect after login
Route::get('redirect',[HomeController::class,'redirect']);







Route::controller(ProductController::class)->group(function(){
    Route::middleware(IsAdmin::class)->group(function(){
        Route::prefix('admin')->group(function(){

            //create
            Route::get('products/create','create');
            Route::post('products/store','store')->name('store');
            //read
            Route::get('products/all','all');
            Route::get('product/show/{id}','show');
            //update
            Route::get('product/edit/{id}','edit');
            Route::put('product/update/{id}','update');
            //delete
            Route::delete('deleteProduct/{id}','delete');
        });
    });

});


Route::controller(CategoryController::class)->group(function(){

Route::middleware(IsAdmin::class)->group(function(){

    Route::get('category/create','create');
    Route::post('category/store','store');
    
    //all categories
    Route::get('categories/all','all');
    Route::get('category/show/{id}','show');
    
    //update
    Route::get('category/edit/{id}','edit');
    Route::put('category/update/{id}','update');
    
    //delete
    Route::delete('category/{id}','delete');
});
});


//localization
Route::get('change/{lang}',function($lang){
if($lang=='ar'){

    session()->put('lang','ar');

}else{
    session()->put('lang','en');
}
return redirect()->back();
});

//user route
Route::controller(ClientController::class)->group(function(){

    Route::get('/home','all');
    Route::get('/show/{id}','show');
 
    Route::get('search','search');
    //cart
    Route::post('cart/{id}','addToCart');
    //clear cart
    Route::get('clearCart','clearCart');
    //myCary
    Route::get('myCart','myCart');
    Route::post('OrderAllCart','OrderAllCart');
    Route::post('orderONe','orderOne');
});

Route::get('aboutUs/',function(){
return view('user.about');
})->name('about');

Route::get('moreProducts/',function(){
return view('user.products');
})->name('moreProducts');

Route::get('contactUs/',function(){
return view("user.contact");
})->name('contactUs');

//logout
Route::post('UserLogout', [HomeController::class, 'logout']);


