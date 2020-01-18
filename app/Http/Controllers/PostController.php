<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function details($slug){
        $post = Post::where('slug',$slug)->approved()->published()->first();
        $randomPost = Post::approved()->published()->take(3)->inRandomOrder()->get();
        $count_key = 'count_'.$post->id;
        if (!Session::has($count_key)){
            $post->increment('view_count');
            Session::put($count_key, 1);
        }
        return view('postDetails',compact('post','randomPost'));
    }

    public function all(){
        $posts = Post::latest()->approved()->published()->paginate(3);
        return view('allPost',compact('posts'));
    }

    public function categoryPost(Request $request, $id){
        $category = Category::where('slug',$id)->get()->first();
        $posts = $category->posts()->approved()->published()->get();
        return view('categoryPost',compact('category','posts'));
    }

    public function tagPost(Request $request, $slug){
        $tag = Tag::where('slug',$slug)->get()->first();
        $posts = $tag->posts()->approved()->published()->get();
        return view('tagPost',compact('tag','posts'));
    }

    public function search(Request $request){
        $query = $request->input('query');
        $post = Post::where('title','LIKE', "%$query%")->get();
       return view('search',compact('post','query'));
    }


}
