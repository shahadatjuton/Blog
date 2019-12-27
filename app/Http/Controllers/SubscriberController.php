<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{

    public function store(request $request)
    {
      $this->validate($request,[
        'email'=>'required|unique:subscribers'
      ]);

      $subscriber = new Subscriber();
      $subscriber->email=$request->email;
      $subscriber->save();

      Toastr::success('Email added in the subscriber list','success');
      return redirect()->back();

    }
}
