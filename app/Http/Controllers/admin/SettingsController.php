<?php

namespace App\Http\Controllers\Admin;

use App\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;


class SettingsController extends Controller
{
     public function index(){
         $user = User::findOrFail(Auth::id());
         return view('admin.settings',compact('user'));
     }

     public function updateProfile(Request $request){

         $this->validate($request,[

             'name'=>'required',
             'email'=>'required|email',

         ]);

         $image = $request->file('image');
         $slug = str::slug($request->name);
         $user = User::findOrFail(Auth::id());

         if (isset($image)) {

             $currant_date = Carbon::now()->toDateString();
             $image_name = $slug.'-'.$currant_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

             //==========Check and set Image Directory==================

             if (!Storage::disk('public')->exists('profile')) {

                 Storage::disk('public')->makeDirectory('profile');

             }

             //==========Check existing image and delete ==================

             if (Storage::disk('public')->exists('profile/'. $user->image )) {

                 Storage::disk('public')->delete('profile/'. $user->image );

             }

             //==========Make new image ==================

             $imageSize=Image::make($image)->resize(500,500)->save($image->getClientOriginalExtension());

             Storage::disk('public')->put('profile/'.$image_name,$imageSize);

         }else {

             $image_name=$user->image ;
         }


         $user->name = $request->name;
         $user->email = $request->email;
         $user->image = $image_name;
         $user->save();

         Toastr::success('Profile  Updated successfully', 'success');
         return redirect()->back();


     }


     public function changePassword(Request $request){
         $user = User::findOrFail(Auth::id());
         $hashed_password = Auth::user()->password;
         $this->validate($request, [
             'old_password'=>'required',
             'password'=>'required|confirmed',
         ]);

         if (Hash::check($request->old_password,$hashed_password)){

             if (!Hash::check($request->password , $hashed_password)){
                 $user->password = Hash::make( $request->password);
                 $user->save();
                 Toastr::success('your password changed successfully!','success');
                 Auth::logout();
                 return redirect()->back();
             }else{
                 Toastr::warning('New password can not be same as old password','warning');
                 return redirect()->back();
             }

         }else{
             Toastr::error('Password does not match','error');
             return redirect()->back();
         }


     }







}
