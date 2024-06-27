@extends("admin.layout")


@section('body')
@include('errors')
@include('success')

@section("title")
    create category
@endsection

<form method="POST" action="{{url('category/store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">category Name</label>
      <input type="text" name="name"  class="form-control text-white" id="exampleInputEmail1" value="{{old("name")}}"  placeholder="Enter name">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Product Description</label>
        <textarea type="text" name="desc" class="form-control text-white" id="exampleInputEmail1" value="{{old("desc")}}"  placeholder="Enter desc"></textarea>
      </div>

   

    <button type="submit" class="btn btn-primary">create</button>
</form>

@endsection