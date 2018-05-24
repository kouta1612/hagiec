<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function show () {
      return view('top');
    }
    public function detail() {
      return view('showDetail');
    }
}
