<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile($name){

        $user = User::where('name',$name)->first();
        $posts = $user->posts()->approved()->published()->get();
        return view('profile',compact('user','posts'));
    }
}
