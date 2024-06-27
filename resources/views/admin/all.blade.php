@extends("admin.layout");

@section('body')

@include("success")

<div class="table-responsive table-responsive-sm">  <table class="table table-sm my-custom-padding">  <thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Title</th>
    <th scope="col">Price</th>
    <th scope="col">Qty</th>
    <th scope="col">Desc...</th> 
    <th scope="col">image</th> 
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
  @foreach ($products as $product)
  <tr>
    <th scope="col">{{$loop->iteration}}</th>
    <td>{{ $product->name }}</td> 
     <td>{{$product->price}}</td>
    <td>{{$product->quantity}}</td>
    <td>{{ Str::limit($product->desc, 20) }}...</td>
    <td><img src="{{asset("storage/$product->image")}}" width="100px" alt="" srcset=""></td>

    <td>
      <a href="{{url("admin/product/show/$product->id")}}" class="btn btn-sm btn-success">
        <i class="fas fa-edit"></i> show </a>
      {{-- <form action="{{url("deleteProduct/$product->id")}}" method="post" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
          <i class="fas fa-trash"></i>delete  </button>
      </form> --}}
    </td>
  </tr>
  @endforeach
</tbody>
</table>
</div>

@endsection