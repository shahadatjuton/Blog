<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{
  public function index()
  {
    $subscribers=Subscriber::latest()->get();
    return view('admin.subscriber',compact('subscribers'));
  }

  public function destroy($id)
  {
    $subscriber = Subscriber::findOrFail($id);
    $subscriber->delete();
    Toastr::success('Subscriber deleted from the list successfully!','success');
    return redirect()->back();

  }

}
