<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function create(){
       return view('admin.creatCategory');
    }

    public function store(Request $request){
     
        //validation
       $data= $request->validate([

            'name'=>'required|string|max:255',
            'desc'=>'required|string'
        ]);
        //store
        Category::create($data);
        //success massage
        session()->flash('success','category added successfully');
        
        //redirect
        return redirect(url('category/create'));
    }


    //all

    public function all(){
        
        //use query builder
      $categories=  DB::table('categories')->get();
      
      return view('admin.allCategories',compact('categories'));
    }


    //show 
    public function show($id){
        

    $category=Category::findOrFail($id);
    // dd($category);
    return view("admin.showCategory",['category'=>$category]);
    }

    public function edit($id){
     $category= DB::table('categories')->where('id',$id)->first();
     return view('admin.editCategory',compact('category'));
     
    }

    //update
    public function update(Request $request ,$id){
       $data= $request->validate([
            'name'=>'required |string|max:255',
            'desc'=>"required|string"
        ]);

        $category=Category::findOrFail($id);
        $category->update($data);

        //redirect
        session()->flash('success','category updated successfully');
        return view("admin.showCategory")->with('category',$category);
    }

    //delete
    public function delete($id){

        $category=Category::findOrFail($id);
        $category->delete();
        return redirect(url('categories/all'))->with('success','one category deleted');
    }


}
