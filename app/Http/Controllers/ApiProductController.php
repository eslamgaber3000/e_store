<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    

    public function all(){


        $products=Product::all();

        if($products->count()==0){
            return response()->json(['massage'=>'empty product'],404);
        }else{

            return ProductResource::collection($products);
        }

    }
    public function show($id){


        $product=Product::find($id);

        if($product == null){
            
            return response()->json(['massage'=>'data not found'],404);
        }
        else{

            return   new ProductResource($product);
        }

    }

    //catch data
    // validation
    //store data 
    public function store(Request $request){

      $validator=Validator::make(
        $request->all(),

        [
            'name'=>'required|string|max:255',
            'desc'=>'required|string',
            'price'=>'required|numeric',
            'quantity'=>'required|integer',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'category_id'=>'required|exists:categories,id'
        ]
      );
      //check 
      if($validator->fails()){

        return response()->json(['errors'=>$validator->errors()],301);
      }

        $imageName=Storage::putFile('products',$request->image);


      Product::create([
        'name'=>$request->name,
        'desc'=>$request->desc,
        'price'=>$request->price,
        'quantity'=>$request->quantity,
        'image'=> $imageName,
        'category_id'=>$request->category_id,

      ]);

     return response()->json(['massage'=>'product added successfully'],201);

    }

 

        public function update(Request $request ,$id){

            $validator=Validator::make(
              $request->all(),
      
              [
                  'name'=>'required|string|max:255',
                  'desc'=>'required|string',
                  'price'=>'required|numeric',
                  'quantity'=>'required|integer',
                  'image' => 'image|mimes:jpeg,jpg,png,gif',
                  'category_id'=>'required|exists:categories,id'
              ]
            );
            //check 
            if($validator->fails()){
      
              return response()->json(['errors'=>$validator->errors()],301);
            }
            //find id
            $product=Product::find($id);

            if($product == null){
                
                return response()->json(['massage'=>'product not found'],404);
            }
            //storage
            $imageName=$product->image;

            if($request->has('image')){

                Storage::delete($imageName);
                $imageName=Storage::putFile('products',$request->image);
            }
            //update
            $product->update([
                'name'=>$request->name,
                'desc'=>$request->desc,
                'price'=>$request->price,
                'quantity'=>$request->quantity,
                'image'=> $imageName,
                'category_id'=>$request->category_id,
            ]);
            //massage
            return response()->json(['massage'=>'product updated successfully',
            'product'=>new ProductResource($product)
            ],201);

    }

    //delete
    public function delete($id){

        //find
        $product=Product::find($id);
        if($product == null){
            return response()->json(['massage'=>'product not found'],404);
        }
        //storage
        if($product->image !== null){

            Storage::delete($product->image);
        }
        //delete
        $product->delete();
        //massage
        return response()->json(['success','product deleted successfully'],200);
    }
}
