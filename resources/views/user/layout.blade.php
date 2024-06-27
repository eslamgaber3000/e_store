<!DOCTYPE html>
<html lang="en" dir="ltr">

 @include('user.head')

  <body>

 <!-- pre loader place -->

    <!-- Header -->
    @include('user.header')

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
        <div class="owl-banner owl-carousel">

          @yield('banner')

        </div>
      </div>
    <!-- Banner Ends Here -->

    @yield('best_product')


   @yield('latest')


    <div class="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <div class="row">
                <div class="col-md-8">
                  <h4>Creative &amp; Unique <em>Sixteen</em> Products</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque corporis amet elite author nulla.</p>
                </div>
                <div class="col-md-4">
                  <a href="#" class="filled-button">{{__('messages.Purchase Now')}}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
@include('user.footer')

  </body>

</html>

