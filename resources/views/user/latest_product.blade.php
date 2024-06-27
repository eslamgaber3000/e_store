

<div class="latest-products">
    <div class="container">
      @include('success')
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>{{__('messages.Latest Products')}}</h2>
            <a href="home">{{__('messages.view all products')}} <i class="fa fa-angle-right"></i></a>
          </div>
          <form action="{{url('search')}}" method="get" class="form">
            <input type="text" class="form-control" name="search" placeholder="search"  value="{{old('search')}}">
            <button type="submit" class="btn btn-info my-3">{{__('messages.search')}}</button>
          </form>
        </div>
        @foreach ($products as $product )
        <div class="col-md-4">
          <div class="product-item">
            <a href="{{url("/show/$product->id")}}"><img src="{{asset("storage/$product->image")}}" alt=""></a>
            <div class="down-content">
              <a href="{{url("/show/$product->id")}}"><h4>{{$product->name}}</h4></a>
              <h6>{{$product->price}}</h6>
              <p>{{ Str::limit($product->desc,200) }}</p>
              @auth
              <ul class="stars">
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
              </ul> 
              {{-- @include('success') --}}
              @error('qty')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
                
              <form action="{{url("cart/$product->id")}}" method="post">
                @csrf
                <button type="submit"class="btn btn-info" ><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                <input type="number"class="" name="qty" id="" placeholder="enter the quantity ">
              </form>
              @endauth
              
            </div>
          </div>
        </div>

        @endforeach
        
        
        </div>
      {{$products->links()}}
  </div>