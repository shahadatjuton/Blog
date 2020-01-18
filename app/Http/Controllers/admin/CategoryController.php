<?php

namespace App\Http\Controllers\Admin;

use App\Category;



// use Brian2694\Toastr\Toastr;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $categories= Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $this->validate($request, [
        'name'=>'required|unique:categories',
        'image'=>'mimes:jpeg,bmp,png,jpg',

      ]);

    //  ==========Get image and slug name==================

      $image =$request->file('image');
      $slug= str_slug($request->name);

    //  ==========Set image name==================

      if (isset($image)) {

          //==========Set image name and date ==================

        $currentDate = Carbon::now()->toDateString();
        $imageName= $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

          //==========Check and set Image Directory==================
          if (!Storage::disk('public')->exists('category')) {

            Storage::disk('public')->makeDirectory('category');

            }

          //==========Check and upload Image  ==================
          // $imageSize = Image::make($image)->resize(1600,479)->save();
          // Storage::disk('public')->put('category/'.$imageName,$imageSize);



          $imageSize=Image::make($image)->resize(1600,479)->save($image->getClientOriginalExtension());


          Storage::disk('public')->put('category/'.$imageName,$imageSize);

          //==========Check and set Slide Image Directory==================

          if (!Storage::disk('public')->exists('category/slider')) {

            Storage::disk('public')->makeDirectory('category/slider');

            }

            //==========Check and set Image Directory==================

            $sliderImageSize=Image::make($image)->resize(500,333)->save($image->getClientOriginalExtension());


            Storage::disk('public')->put('category/slider/'.$imageName,$sliderImageSize);







    }else {

        $imageName="default.png";
    }





    $category= new Category();

    $category->name= $request->name;
    $category->slug= $slug;
    $category->image= $imageName;
    $category->save();


    Toastr::success('Category  Created successfully', 'success');
    return redirect()->route('admin.category.index');




}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $category= Category::find($id);
      return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
         {
           $this->validate($request, [
             'name'=>'required',
             'image'=>'mimes:jpeg,bmp,png,jpg',

           ]);




           //  ==========Get image and slug name==================

           $image =$request->file('image');
           $slug= str_slug($request->name);

             $category = Category::find($id);

           //  ==========Set image name==================

           if (isset($image)) {

               //==========Set image name and date ==================

             $currentDate = Carbon::now()->toDateString();
             $imageName= $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

               //==========Check and set Image Directory==================
               if (!Storage::disk('public')->exists('category')) {

                 Storage::disk('public')->makeDirectory('category');

                 }

                 //===================Delete old slider image==================

                 if (Storage::disk('public')->exists('category/'. $category->image )) {

                   Storage::disk('public')->delete('category/'. $category->image );

                   }
               //==========Check and upload Image  ==================

               $imageSize=Image::make($image)->resize(1600,479)->save($image->getClientOriginalExtension());


               Storage::disk('public')->put('category/'.$imageName,$imageSize);

               // //==========Check and set Slide Image Directory==================

               if (!Storage::disk('public')->exists('category/slider')) {

                 Storage::disk('public')->makeDirectory('category/slider');

                 }
                 //===================Delete old slider image==================

                 if (Storage::disk('public')->exists('category/slider/'. $category->image )) {

                   Storage::disk('public')->delete('category/slider/'. $category->image );

                   }
                 //==========Check and set Image Directory==================

                 $sliderImageSize=Image::make($image)->resize(500,333)->save($image->getClientOriginalExtension());


                 Storage::disk('public')->put('category/slider/'.$imageName,$sliderImageSize);


           }else {

             $imageName=$category->image;
           }

           $category->name= $request->name;
           $category->slug= $slug;
           $category->image= $imageName;
           $category->save();
           Toastr::success('Category  updated successfully', 'success');
           return redirect()->route('admin.category.index');



         }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $category = Category::find($id);

     if(Storage::disk('public')->exists('category/'.$category->image)){
       Storage::disk('public')->delete('category/'.$category->image);
     }
     if(Storage::disk('public')->exists('category/slider'.$category->image)){
       Storage::disk('public')->delete('category/slider'.$category->image);
     }

     $category->delete();
     toastr::success('Data is deleted successfully!!','success');
     return redirect()->back();

    }
}
