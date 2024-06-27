 <!-- ***** Preloader Start ***** -->
 <div id="preloader">
  <div class="jumper">
      <div></div>
      <div></div>
      <div></div>
  </div>
</div>  
<!-- ***** Preloader End ***** -->

<header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="{{url("dashboard/")}}"><h2>Sixteen <em>Clothing</em></h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{url('home')}}">{{__('messages.Home')}}
                <span class="sr-only">(current)</span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="{{route("moreProducts")}}">{{__('messages.Our Products')}}</a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="{{route('about')}}">{{__('messages.About Us')}}</a>
            </li>
            @if (session()->has('lang') && session()->get('lang')=='ar')
            <li class="nav-item">
              <a class="nav-link" href="{{url("change/en")}}">English</a>
            </li>
            @else 
            <li class="nav-item">
              <a class="nav-link" href="{{url("change/ar")}}">العربية</a>
            </li>
            @endif
            @auth
              
            <li class="nav-item">
              <a class="nav-link" href="{{url('myCart')}}">{{__('messages.My Cart')}}</a>
              </li>
            @endauth
            @auth
            <li class="nav-item">
              <a  >
                <form action="{{url("UserLogout")}}" method="post">
                  @csrf
                  <button type="submit" class="nav-link">{{__('messages.Logout')}}</button>
                </form>
              </a>
            </li>
            @endauth
            @guest
            <li class="nav-item">
              <a  >
                <form action="{{route("login")}}" method="get">
                  @csrf
                  <button type="submit" class="nav-link">{{__('messages.Login')}}</button>
                </form>
              </a>
            </li>
            @endguest
           
          </ul>
        </div>
      </div>
    </nav>
  </header>