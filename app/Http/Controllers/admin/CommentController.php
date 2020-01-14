<?php

namespace App\Http\Controllers\admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;


class CommentController extends Controller
{
    public function index(){
        $comments = Comment::latest()->get();
        return view('admin.comments',compact('comments'));
    }

    public function destroy($id){
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back();
        Toastr::success('The comment has been deleted successfully!');
    }
}
