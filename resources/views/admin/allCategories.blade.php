@extends("admin.layout");

@section('body')

@include("success")
@section('title')
    all categories
@endsection

<div class="table-responsive table-responsive-sm">  <table class="table table-sm my-custom-padding">  <thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Title</th>
    <th scope="col">Desc...</th> 
    <th scope="col">action</th> 

  </tr>
</thead>
<tbody>
  @foreach ($categories as $category)
  <tr>
    <th scope="col">{{$loop->iteration}}</th>
    <td>{{ $category->name }}</td> 
    <td>{{ Str::limit($category->desc, 20) }}...</td>
    <td>
      <a href="{{url("category/show/$category->id")}}" class="btn btn-sm btn-info">
        <i class="fas fa-edit "></i> show </a>
    </td>
  </tr>
  @endforeach
</tbody>
</table>
</div>

@endsection