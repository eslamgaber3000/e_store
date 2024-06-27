<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create(){
    $categories=Category::all();
    return view('admin.create',compact("categories"));
    }


    public function store(Request $request){
        //1-catch data be in $request
        
        //2-validation
        $data=$request->validate([

            'name'=>'required|string|max:255',
            'desc'=>'required|string',
            'price'=>'required|numeric',
            'quantity'=>'required|integer',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'category_id'=>'required|exists:categories,id'


        ]);
        //storage
        $data['image']=Storage::putFile('products',$data['image']);
        //create
        Product::create($data);
        //store in session
        session()->flash('success','data created successfully');
        //redirect
        return redirect(url("admin/products/create"));


    }

    //all

    public function all(){
        $products=Product::all();
        return view("admin.all")->with('products',$products);
    }
    public function show($id){

        $product=Product::findOrFail($id);
        // dd($product);
        return view("admin.show",compact("product"));
    }

    //edit
    public function edit($id){
        $product=Product::findOrFail($id);
        $categories=Category::all();
        return view('admin.edit',['product'=>$product,'categories'=>$categories]);
    }

    public function update (Request $request, $id){
      $data= $request->validate([
        
        'name'=>'required|string|max:255',
        'desc'=>'required|string',
        'price'=>'required|numeric',
        'quantity'=>'required|integer',
        'image' => 'image|mimes:jpeg,jpg,png,gif',
        'category_id'=>'required|exists:categories,id'
       ]);
       //get old image
       $product = Product::find($id);
        $oldImage = $product->image;
        if($request->has('image')){
            Storage::delete($oldImage);
            $data['image']=Storage::putFile('products',$data['image']);
        }
        //update
        $product->update($data);
        return redirect(url("admin/product/show/$id"))->with('success','data updated successfully');
    }

    //delete
    public function delete($id){
        //delete from storage then delete
        //get image then delete it
        $product=Product::findOrFail($id);
        $image=$product->image;
        Storage::delete($image);
        $product->delete();
        session()->flash('success','data deleted successfully');
        return redirect(url("admin/products/all"));
    }
    

}
