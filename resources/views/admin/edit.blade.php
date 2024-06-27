@extends('admin.layout')


@section('body')
@include('errors')

<form method="POST" action="{{url("admin/product/update/$product->id")}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="exampleInputEmail1">product Name</label>
      <input type="text" name="name" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$product->name}}">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">product desc</label>
        <textarea type="text" name="desc" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" >{{$product->desc}}</textarea>
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">product Price</label>
        <input type="number" name="price" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$product->price}}">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">product quantity</label>
        <input type="text" name="quantity" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$product->quantity}}">
      </div>

      

      <div class="form-group">
        <label for="exampleInputEmail1">old image</label>
        <img src="{{asset("storage/$product->image")}}" width="100" alt="" srcset="">
        <input type="file" name="image" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter image">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1"> category</label>
        <select name="category_id" id="">
          {{-- <option >
            {{$category->name}}
        </option> --}}
          @foreach ($categories as $category )
          <option value="{{$category->id}}">
              {{$category->name}}
          </option>
          @endforeach
        </select>
      </div>

     

    <button type="submit" class="btn btn-primary">Update</button>
  </form>

    
@endsection