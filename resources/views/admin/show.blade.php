
@extends("admin.layout")
@section('title')
    show product
@endsection
@section('body')
<div class="container mt-5 p-2 bg-wite">
  @include('success')
    <div class="card product-card mb-3">
        <div class="row no-gutters">
          <div class="col-md-4">
            <a href="{{ url("product/$product->id") }}">
              <img src="{{ asset("storage/$product->image") }}" class="card-img rounded product-img" style="width: 175px; " alt="{{ $product->name }}">
            </a>
          </div>
          <div class="col-md-8">
            <div class="card-body d-flex flex-column justify-content-between">
              <div class="product-details">
                <h5 class="card-title">{{ $product->name }}</h5>
                <h5 class="card-title">{{ $product->category->name }}</h5>
                <p class="card-text">{{ $product->desc }}</p>
                <div class="d-flex align-items-center">
                  <span class="badge bg-primary me-2">Price: {{ $product->price }}</span>
                  <span class="badge bg-success">Quantity: {{ $product->quantity }}</span>
                </div>
              </div>
              <div class="product-actions d-flex justify-content-end">
                <a href="{{ url("admin/product/edit/$product->id") }}" class="btn btn-sm btn-info me-2">
                  <i class="fas fa-edit"></i> Edit
                </a>
                <form id="deleteForm" action="{{ url("admin/deleteProduct/$product->id") }}" method="post" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete(event)">
                      <i class="fas fa-trash"></i> Delete
                  </button>
              </form>
              
              <script>
              function confirmDelete(event) {
                  event.preventDefault(); // Prevent the default form submission
              
                  if (confirm("Are you sure you want to delete this product?")) {
                      // If the user confirms the deletion, submit the form
                      document.getElementById("deleteForm").submit();
                  }
              }
              </script>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
   
    
  
      
  