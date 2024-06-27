@extends('admin.layout')


@section('body')
@include('errors')

<form method="POST" action="{{url("category/update/$category->id")}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="exampleInputEmail1">category Name</label>
      <input type="text" name="name" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$category->name}}">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">category desc</label>
        <textarea type="text" name="desc" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" >{{$category->desc}}</textarea>
      </div>

    <button type="submit" class="btn btn-primary">Update</button>
  </form>

    
@endsection