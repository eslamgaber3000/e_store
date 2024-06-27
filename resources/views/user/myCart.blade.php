<!DOCTYPE html>
<html lang="en">

@include('user.head')


@section('title')
    My Cary
@endsection

<body>

    @include('user.header')

    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>new arrivals</h4>
                        <h2>sixteen products</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="products py-5">

      <div class="container">
        <div class="row mb-4">
                <div class="col-md-12">
                    <div class="filters text-center">
                        <ul class="list-inline">
                            <li class="list-inline-item active" data-filter="*">All Products</li>
                            <li class="list-inline-item" data-filter=".des">Featured</li>
                            <li class="list-inline-item" data-filter=".dev">Flash Deals</li>
                            <li class="list-inline-item" data-filter=".gra">Last Minute</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="filters-content">
                      @include('errors')
                        <div class="row grid">
                            @if (!empty($products))
                                @foreach ($products as $product)
                                    <div class="col-lg-4 col-md-6 mb-4 all des">
                                        <div class="card h-100">
                                            <a href="#"><img src="{{ asset("storage/{$product['image']}") }}"
                                                    class="card-img-top img-fluid" alt=""></a>
                                                  <div class="card-body">
                                                
                                                        <h5 class="card-title"><a
                                                                href="#">{{ $product['name'] }}</a></h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">
                                                            {{ $product['price'] }}</h6>
                                                        <p class="card-text">Quantity: {{ $product['qty'] }}</p>
                                                    </div>

                                                    
                                                        <form action="{{ url('orderONe') }}" method="post"
                                                            class="mt-4 text-center">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="day">Select Date:</label>
                                                                <input type="date" name="dayOne" id="day"
                                                                    class="form-control">
                                                            </div>
                                                            <button type="submit" class="btn btn-info">
                                                                <i class="fa fa-shopping-cart"></i> Order Now
                                                            </button>
                                                        </form>

                                                    

                                                </div>

                                            </div>
                                        </div>
                                @endforeach
                                </div>
                                  <form action="{{ url('OrderAllCart') }}" method="post" class="mt-4 text-center">
                                      @csrf
                                      <div class="form-group">
                                          <label for="day">Select Date:</label>
                                          <input type="date" name="dayAll" id="day" class="form-control">
                                      </div>
                                      <button type="submit" class="btn btn-info">
                                          <i class="fa fa-shopping-cart"></i> Order All Now
                                      </button>
                                  </form>
                        @endif
                    </div>
                </div>
            </div> --}}
            <div class="row">
              <div class="col-md-12">
                <div class="filters-content">
                  @include('errors')
                
                  <div class="row grid">
                    @if(!empty($products))
                      @foreach($products as $product)
                      
                        <div class="col-lg-4 col-md-6 mb-4 all des">
                          
                          <div class="card h-100">
                            
                            <a href="#"><img src="{{ asset('storage/'.$product['image']) }}" class="card-img-top img-fluid" alt=""></a>
                              
                            <div class="card-body">
                              
                              <h5 class="card-title"><a href="#">{{ $product['name'] }}</a></h5>
                              
                              <h6 class="card-subtitle mb-2 text-muted">{{ $product['price'] }}</h6>
                              
                              <p class="card-text">Quantity: {{ $product['qty'] }}</p>
                              
                            </div> <!-- closing card-body -->
                              
                            <div>
                              
                              <form action="{{ url('orderONe') }}" method="post" class="mt-4 text-center">
                                
                                @csrf
                                
                                <div class="form-group">
                                  
                                  <label for="day">Select Date:</label>
                                  
                                  <input type="date" name="dayOne" id="day" class="form-control">
                                  
                                </div>
                                
                                <button type="submit" class="btn btn-primary m-3">
                                  
                                  <i class="fa fa-shopping-cart"></i> Order Now
                                  
                                </button>
                                
                              </form>
                              
                            </div>
                            
                          </div> <!-- closing card -->
                          
                        </div>
                        
                      @endforeach
                    
                    </div>
                    
                    <form action="{{ url('OrderAllCart') }}" method="post" class="mt-4 text-center">
                      
                      @csrf
                      
                      <div class="form-group">
                        
                        <label for="day">Select Date:</label>
                        
                        <input type="date" name="dayAll" id="day" class="form-control">
                        
                      </div>
                      
                      <button type="submit" class="btn btn-info">
                        
                        <i class="fa fa-shopping-cart"></i> Order All Now
                        
                      </button>
                      
                    </form>
                    
                  @endif
                  
                </div>
              </div>
            </div>
        </div>
    </div>
    
    @include('user.footer')


</body>

</html>
