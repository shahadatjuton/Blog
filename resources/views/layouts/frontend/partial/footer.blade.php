<footer>

  <div class="container">
    <div class="row">

      <div class="col-lg-4 col-md-6">
        <div class="footer-section">

          <a class="logo" href="#"><h4>My Blog</h4></a>
          <p class="copyright">@2019 All rights reserved.</p>
          <p class="copyright">Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
            <p class="copyright">Developed by <a href="https://colorlib.com" target="_blank">Shahadat Hossain</a></p>

            <ul class="icons">
            <li><a href="https://www.facebook.com/"><i class="ion-social-facebook-outline"></i></a></li>
            <li><a href="#"><i class="ion-social-twitter-outline"></i></a></li>
            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
            <li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
            <li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li>
          </ul>

        </div><!-- footer-section -->
      </div><!-- col-lg-4 col-md-6 -->
@php
$categories = \App\Category::all();
@endphp
      <div class="col-lg-4 col-md-6">
          <div class="footer-section">
          <h4 class="title"><b>CATAGORIES</b></h4>
          <ul>
              @foreach($categories as $category)
              <li><a href="{{route('post.category',$category->slug)}}">{{$category->name}}</a></li>
              @endforeach
          </ul>
        </div><!-- footer-section -->
      </div><!-- col-lg-4 col-md-6 -->

      <div class="col-lg-4 col-md-6">
        <div class="footer-section">

            <h4 class="title"><b>SUBSCRIBE</b></h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="input-area">
                <form method="post" action="{{route('subscriber.store')}}">
                    @csrf
                    <input class="email-input" type="text" placeholder="Enter your email" name="email">
                    <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
                </form>
            </div>

        </div><!-- footer-section -->
      </div><!-- col-lg-4 col-md-6 -->

    </div><!-- row -->
  </div><!-- container -->
</footer>
