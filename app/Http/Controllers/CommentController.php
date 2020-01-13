<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;


class CommentController extends Controller
{
    public function store(Request $request, $id){
        $this->validate( $request, [
           'comment'=>'required'
        ]);

        $comment = new Comment();
        $user_id = Auth::id();
        $comment->user_id=$user_id;
        $comment->post_id=$id;
        $comment->comment=$request->comment;
        $comment->save();
        Toastr::success('Comment is posted successfully!','success');
        return redirect()->back();
    }
}
