<?php

namespace App\Http\Controllers\author;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function index(){
        $posts = Auth::user()->posts;
        return view('author.comments',compact('posts'));
    }

    public function destroy($id){
        $comment = Comment::findOrFail($id);
        if ($comment->user->id == Auth::id()){
            $comment->delete();
            Toastr::success('The comment has been deleted successfully!');
        }else{
            Toastr::warning('You are not able to delete this comment. Access Denied!');

        }
        return redirect()->back();


    }
}
