<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        $user = User::Author()
            ->withCount('posts')
            ->withCount('comments')
            ->withCount('favourite_posts')
            ->get();
        return view('admin.users',compact('user'));
    }
}
