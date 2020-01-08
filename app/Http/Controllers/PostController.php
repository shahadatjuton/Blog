<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function details($slug){
        $post = Post::where('slug',$slug)->first();
        $randomPost = Post::all()->random(3);
        return view('postDetails',compact('post','randomPost'));
    }
}
