<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Response;

class TestController extends Controller
{
  public function test(Request $request) {
    return view('test');
  }

  public function ajax(Request $request) {
    return $request->word.$request->name;
  }

}
