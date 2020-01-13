@extends('layouts.frontend.app')


@section('title')
{{$post->title}}
@endsection

@push('css')
<link href="{{ asset('assets/frontend/css/single_post/styles.css')}}" rel="stylesheet">

<link href="{{ asset('assets/frontend/css/single_post/responsive.css')}}" rel="stylesheet">


<style>
    .header-bg{
        height: 400px;
        width: 100%;
        background-image: url({{ asset('storage/post/'.$post->image) }});
        background-size: cover;
    }
    .favourite_post{
        color: #1210ff;
    }
</style>



@endpush

@section('content')


    <div class="header-bg">
    </div><!-- slider -->

    <section class="post-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12 no-right-padding">

                    <div class="main-post">

                        <div class="blog-post-inner">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{asset('storage/profile/'. $post->user->image)}}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{$post->user->name}}</b></a>
                                    <h6 class="date">{{$post->created_at->diffForHumans()}}</h6>
                                </div>

                            </div><!-- post-info -->

                            <h3 class="title"><a href="#"><b>{{$post->title}}</b></a></h3>

                            <p class="para">{!! html_entity_decode($post->body) !!}</p>

                            <div class="post-image"><img src="images/blog-1-1000x600.jpg" alt="Blog Image"></div>

                            <ul class="tags">
                                @foreach($post->tags as $tag)
                                    <li><a href="#">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">

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
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                            </ul>

                            <ul class="icons">
                                <li>SHARE : </li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                            </ul>
                        </div>


                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="sidebar-area about-area">
                            <h4 class="title"><b>ABOUT BONA</b></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                                Ut enim ad minim veniam</p>
                        </div>


                        <div class="tag-area">

                            <h4 class="title"><b>CATEGORY CLOUD</b></h4>
                            <ul>
                                @foreach($post->categories as $category)
                                <li><a href="#">{{$category->name}}</a></li>
                                 @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">
@foreach($randomPost as $random)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{asset('storage/post/'.$random->image)}}" alt="Blog Image"></div>

                            <a class="avatar" href="#"><img src="{{asset('storage/profile/'. $random->user->image)}}" alt="Profile Image"></a>


                            <div class="blog-info">

                                <h4 class="title"><a href="{{route('post.details',$random->slug)}}"><b>{{$random->title}}</b></a></h4>

                                <ul class="post-footer">

                                    <li>
                                        @guest
                                            <a href="javascript:void(0);"
                                               onclick="toastr.info('You have to login first to add the post in the favourite list.','info',{
                            closeButton:true,
                            progressBar:true,
                        })"><i class="ion-heart"></i>{{ $random->favourite_to_users()->count() }}</a>

                                        @else

                                            <a href="javascript:void(0);"
                                               onclick="document.getElementById('favourite-post-{{$random->id}}').submit();"
                                               class="{{!Auth::user()->favourite_posts()->where('post_id',$random->id)->count() == 0 ? 'favourite_post':''}}"><i class="ion-heart"></i>{{ $post->favourite_to_users()->count() }}</a>
                                            <form id="favourite-post-{{$random->id}}" action="{{route('post.favourite',$random->id)}}" method="post">
                                                @csrf
                                            </form>

                                        @endguest
                                    </li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{$random->view_count}}</a></li>
                                </ul>


                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-md-6 col-sm-12 -->
@endforeach
            </div><!-- row -->

        </div><!-- container -->
    </section>

    <section class="comment-section">
        <div class="container">
            <h4><b>POST COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{route('comment.store',$post->id)}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
                                              placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                </div><!-- col-sm-12 -->
                                <div class="col-sm-12">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                </div><!-- col-sm-12 -->

                            </div><!-- row -->
                        </form>
                    </div><!-- comment-form -->

                    <h4><b>COMMENTS({{$post->comments->count()}})</b></h4>

                    <div class="commnets-area">
@forelse($post->comments as $comment)
                        <div class="comment">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{ asset('storage/profile/'.$comment->user->image) }}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{$comment->user->name}}</b></a>
                                    <h6 class="date">{{$comment->created_at->diffForHumans()}}</h6>
                                </div>


                            </div><!-- post-info -->

                            <p>{{$comment->comment}}</p>

                        </div>
@empty
    <div class="bg-info">
        <h4> No comment is available for this post! </h4>
    </div>
@endforelse

                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>

@endsection


@push('js')


@endpush
