@extends('admin.layout')
@section('title')
    show category
@endsection



@section('body')


<div class="container mt-5 p-2 bg-light">
    @include("errors")
    @include('success')
    <div class="card product-card border-primary shadow mb-3">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="product-details">
                        <h5 class="card-title text-primary">{{ $category->name }}</h5>
                        @foreach ($category->products as $product)
                        <h6 class="card-subtitle mb-2 text-muted">
                          <a href="{{ url("product/show/$product->id") }}" class="text-muted unstyled-link">{{ $product->name }}</a>
                        </h6>
                        @endforeach
                        <p class="card-text">{{ $category->desc }}</p>
                    </div>
                    <div class="product-actions d-flex justify-content-end">
                        <a href="{{ url("category/edit/$category->id") }}" class="btn btn-sm btn-info me-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ url("category/$category->id") }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



