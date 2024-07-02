@extends("admin.layout");

@section('body')

@include("success")

<div class="table-responsive table-responsive-sm">  <table class="table table-sm my-custom-padding">  <thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">name</th>
    <th scope="col">phone</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
  @foreach ($users as $user)
  <tr>
    <th scope="col">{{$loop->iteration}}</th>
    <td>{{ $user->name }}</td> 
     <td>{{$user->phone}}</td>
    {{-- <td>{{$product->quantity}}</td>
    <td>{{ Str::limit($product->desc, 20) }}...</td>
    <td><img src="{{asset("storage/$product->image")}}" width="100px" alt="" srcset=""></td> --}}

    <td>
      <a href="{{url("sms/$user->id")}}" class="btn btn-sm btn-success">
        <i class="fas fa-edit"></i> show </a>

    </td>
  </tr>
  @endforeach
</tbody>
</table>
</div>

@endsection