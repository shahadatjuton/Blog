@extends('layouts.frontend.app')


@section('title','Profile')


@push('css')
<link href="{{ asset('assets/frontend/css/profile/styles.css')}}" rel="stylesheet">

<link href="{{ asset('assets/frontend/css/profile/responsive.css')}}" rel="stylesheet">


<style>
    .favourite_post{
        color: #1210ff;
    }

    .slider {
        height: 400px;
        width: 100%;
        background-image: url({{asset('storage/profile/'.$user->image)}});
        background-size: cover;
    }
</style>



@endpush

@section('content')
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>{{$user->name}}</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        @forelse($posts as $post)
                            <div class="col-md-6 col-sm-12">
                                <div class="card h-100">
                                    <div class="single-post post-style-1">
                                        <div class="blog-image">
                                            <img src="{{asset('storage/post/'.$post->image)}}" alt="Image"  class="img-fluid">
                                        </div>
                                        <a class="avatar" href="{{route('profile', $post->user->name)}}"><img src="{{asset('storage/profile/'.$post->user->image)}}" alt="Profile Image"></a>

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
                            <h4>No Post Is Available For This Author!</h4>
                        @endforelse
                    </div><!-- row -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 ">

                    <div class="single-post info-area ">

                        <div class="about-area">
                            <h4 class="title"><b>ABOUT AUTHOR</b></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                                Ut enim ad minim veniam</p>
                        </div>
                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- section -->

@endsection


@push('js')


@endpush
