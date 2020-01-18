@extends('layouts.frontend.app')


@section('title', 'Home')


@push('css')
<link href="{{ asset('assets/frontend/css/home/styles.css')}}" rel="stylesheet">

<link href="{{ asset('assets/frontend/css/home/responsive.css')}}" rel="stylesheet">

    <style>
        .favourite_post{
            color: #1a31fa;
        }
    </style>

@endpush

@section('content')

    <div class="main-slider">
        <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
             data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
             data-swiper-breakpoints="true" data-swiper-loop="true" >
            <div class="swiper-wrapper">

                @forelse($categories as $category)
                    <div class="swiper-slide">
                        <a class="slider-category" href="{{ route('post.category',$category->slug) }}">
                            <div class="blog-image"><img src="{{ asset('storage/category/slider/'.$category->image) }}" alt="{{ $category->name }}"></div>

                            <div class="category">
                                <div class="display-table center-text">
                                    <div class="display-table-cell">
                                        <h3><b>{{ $category->name }}</b></h3>
                                    </div>
                                </div>
                            </div>

                        </a>
                    </div><!-- swiper-slide -->
                @empty
                    <div class="swiper-slide">
                        <strong>No Data Found :(</strong>
                    </div><!-- swiper-slide -->
                @endforelse

            </div><!-- swiper-wrapper -->

        </div><!-- swiper-container -->

    </div><!-- slider -->

<section class="blog-area section">
  <div class="container">

    <div class="row">
@forelse($posts as $post)
      <div class="col-lg-4 col-md-6">
        <div class="card h-100">
          <div class="single-post post-style-1">
            <div class="blog-image">
                <img src="{{asset('storage/post/'.$post->image)}}" alt="Image"  class="img-fluid">
            </div>
            <a class="avatar" href="#"><img src="{{asset('storage/profile/'.$post->user->image)}}" alt="Profile Image"></a>

            <div class="blog-info">

              <h4 class="title"><a href="{{route('post.details', $post->slug)}}"><b>{{$post->title}}</b></a></h4>

              <ul class="post-footer">

                <li>
                    @guest
                        <a href="javascript:void(0);"
                    onclick="toastr.info('You have to login first to add the post in the favourite list.','info',{
                            closeButton:true,
                            progressBar:true,
                        })"><i class="ion-heart"></i>{{ $post->favourite_to_users()->count() }}</a>

                    @else

                        <a href="javascript:void(0);"
                           onclick="document.getElementById('favourite-post-{{$post->id}}').submit();"
                        class="{{!Auth::user()->favourite_posts()->where('post_id',$post->id)->count() == 0 ? 'favourite_post':''}}"><i class="ion-heart"></i>{{ $post->favourite_to_users()->count() }}</a>
                        <form id="favourite-post-{{$post->id}}" action="{{route('post.favourite',$post->id)}}" method="post">
                            @csrf
                        </form>

                    @endguest
                </li>
                <li><a href="#"><i class="ion-chatbubble"></i>{{$post->comments->count()}}</a></li>
                <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
              </ul>

            </div><!-- blog-info -->
          </div><!-- single-post -->
        </div><!-- card -->
      </div><!-- col-lg-4 col-md-6 -->
@empty
@endforelse
    </div><!-- row -->

    <a class="load-more-btn" href="#" onclick="alert('ok')"><b>LOAD MORE</b></a>

  </div><!-- container -->
</section><!-- section -->


@endsection


@push('js')


  <script src="{{ asset('assets/frontend/js/swiper.js')}}"></script>

@endpush
