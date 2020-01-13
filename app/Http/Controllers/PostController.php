<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function details($slug){
        $post = Post::where('slug',$slug)->first();
        $randomPost = Post::all()->random(3);
        $count_key = 'count_'.$post->id;
        if (!Session::has($count_key)){
            $post->increment('view_count');
            Session::put($count_key, 1);
        }
        return view('postDetails',compact('post','randomPost'));
    }

    public function all(){
        $posts = Post::latest()->paginate(3);
        return view('allPost',compact('posts'));
    }


}
