<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;


class FavouriteController extends Controller
{
    public function favourite($id){
        $user = Auth::user();
        $favouriteCheck = $user->favourite_posts()->where('post_id',$id)->count();

       if ($favouriteCheck == 0){
           $user->favourite_posts()->attach($id);
           Toastr::success('This post is added into your favourite list','success');
           return redirect()->back();
       }else{
           $user->favourite_posts()->detach($id);
           Toastr::success('This post successfully removed from your favourite list','success');
           return redirect()->back();
       }
    }



        public function favouritePosts(){
                $favourite_post = Auth::user()->favourite_posts;
                return view('favouritePost', compact('favourite_post'));

        }


}
