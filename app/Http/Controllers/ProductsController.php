<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductsController extends Controller
{
    public function logout() {
      // dd('aaaaa');
      Auth::logout();
      return redirect('login');
    }
    public function top() {
      $id = Auth::id();
      $items = Product::all();
      $categorys = Category::all();
      return view('top', ['items' => $items, 'categorys' => $categorys, 'id' => $id]);
    }
    public function detail($id) {
      $item_id = Product::findOrFail($id);
      return view('detail', ['item_id' => $item_id]);
    }
    public function cart() {
      $cart_item = Product::findOrFail();
      return view('cart');
    }
    public function confirm() {
      return view('confirm');
    }
    public function done_payment() {
      return view('done_payment');
    }
}
