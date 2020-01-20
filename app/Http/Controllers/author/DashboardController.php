<?php

namespace App\Http\Controllers\author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user  = Auth::user();
        $post = $user->posts;
        $popular_posts = $user->posts()->withCount('favourite_to_users')
            ->withCount('comments')
            ->orderBy('view_count','desc')
            ->orderBy('favourite_to_users_count')
            ->orderBy('comments_count')
            ->take(5)->get();
        $pending_posts = $post->where('is_approved', false)->count();
        $total_view = $post->sum('view_count');

        return view('author.dashboard',compact('post','popular_posts','pending_posts','total_view'));
    }
}
