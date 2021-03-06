<?php

namespace App\Http\Controllers\admin;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories =Category::all();
      $tags =Tag::all();
        return view('admin.post.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request,[

          'title'=>'required',
          'image'=>'mimes:jpeg,bmp,png,jpg',
          'categories'=>'required',
          'tags'=>'required',
          'body'=>'required',


        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);

        if (isset($image)) {

          $currant_date=Carbon::now()->toDateString();
          $image_name=$slug.'-'.$currant_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

          //==========Check and set Image Directory==================
          if (!Storage::disk('public')->exists('post')) {

            Storage::disk('public')->makeDirectory('post');

            }

            $imageSize=Image::make($image)->resize(1600,1066)->save($image->getClientOriginalExtension());


            Storage::disk('public')->put('post/'.$image_name,$imageSize);

        }else {

            $image_name="default.png";
        }

        $post =new Post();
        $post->user_id= Auth::id();
        $post->title=$request->title;
        $post->slug=$slug;
        $post->image=$image_name;
        $post->body=$request->body;
        if (isset($request->status)) {
          $post->status=true;
        }else {
          $post->status=false;

        }
        $post->is_approved=true;
        $post->save();


        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        Toastr::success('Category  Created successfully', 'success');
        return redirect()->route('admin.post.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
      $categories =Category::all();
      $tags =Tag::all();
        return view('admin.post.edit', compact('categories','tags','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      $this->validate($request,[

        'title'=>'required',
        'image'=>'image',
        'categories'=>'required',
        'tags'=>'required',
        'body'=>'required',


      ]);

      $image = $request->file('image');
      $slug = str_slug($request->title);

      if (isset($image)) {

        $currant_date=Carbon::now()->toDateString();
        $image_name=$slug.'-'.$currant_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

        //==========Check and set Image Directory==================
        if (!Storage::disk('public')->exists('post')) {

          Storage::disk('public')->makeDirectory('post');

          }

          if (Storage::disk('public')->exists('post/'. $post->image )) {

            Storage::disk('public')->delete('post/'. $post->image );

            }

          $imageSize=Image::make($image)->resize(1600,1066)->save($image->getClientOriginalExtension());


          Storage::disk('public')->put('post/'.$image_name,$imageSize);

      }else {

          $image_name=$post->image ;
      }

      $post->user_id = Auth::id();
       $post->title = $request->title;
       $post->slug = $slug;
       $post->image = $image_name;
       $post->body = $request->body;
       if(isset($request->status))
       {
           $post->status = true;
       }else {
           $post->status = false;
       }
       $post->is_approved = true;
       $post->save();


      $post->categories()->sync($request->categories);
      $post->tags()->sync($request->tags);

      Toastr::success('Category  Updated successfully', 'success');
      return redirect()->route('admin.post.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {


        if(Storage::disk('public')->exists('post/'.$post->image)){
            Storage::disk('public')->delete('post/'.$post->image);
        }

        $post->categories()->detach();
        $post->tags()->detach();


        $post->delete();
        toastr::success('Data is deleted successfully!!','success');
        return redirect()->back();
    }


    public function pending()
    {
        $posts = Post::where('is_approved',false)->get();
        return view('admin.post.pending',compact('posts'));
    }

    public function approval($id)
    {
        $post = Post::find($id);
        if ($post->is_approved == false)
        {
            $post->is_approved = true;
            $post->save();

            Toastr::success('Post Successfully Approved :)','Success');
        } else {
            Toastr::info('This Post is already approved','Info');
        }
        return redirect()->back();
    }

}
