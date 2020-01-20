<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user  = Auth::user();
        $post = Post::all()->count();
        $popular_posts = Post::withCount('favourite_to_users')
            ->withCount('comments')
            ->orderBy('view_count','desc')
            ->orderBy('favourite_to_users_count')
            ->orderBy('comments_count')
            ->take(5)->get();
        $pending_posts = Post::where('is_approved', false)->count();
        $total_view = Post::sum('view_count');
        $author_count = User::where('role_id', 2)->count();
        $new_author = User::where('role_id', 2)
            ->whereDate('created_At', Carbon::today())->count();
        $categories = Category::all()->count();
        $tags= Tag::all()->count();


        return view('admin.dashboard',compact('post','categories','tags'
        ,'popular_posts','pending_posts','total_view','author_count','new_author'));
    }
}
