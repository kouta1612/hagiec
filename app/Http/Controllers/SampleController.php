<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Order;
use App\Delivery;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleNotification;

class SampleController extends Controller
{
  public function SampleNotification() {
    $user_id = Auth::id();
    $name = User::find($user_id)->first()->name;
    $delivery_day = Order::where('user_id', $user_id)->orderBy('id', 'desc')->first()->delivery_day;
    $delivery = Delivery::where('user_id', $user_id)->where('status', 1)->first();
    $delivery_place = $delivery->state.$delivery->city.$delivery->street.$delivery->building;
    $to = 'kouta1612world69@gmail.com';
    Mail::to($to)->send(new SampleNotification($name, $delivery_day, $delivery_place));
    return view('test');
  }
}
