<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Cart;
use App\User;

class ItemsController extends Controller
{
    public function logout() {
      Auth::logout();
      return redirect('login');
    }

    public function top() {
      $user_id = Auth::id();
      $items = Item::all();
      $categorys = Category::all();
      return view('top', ['items' => $items, 'categorys' => $categorys, 'user_id' => $user_id]);
    }

    public function detail($id) {
      $item_id = Item::find($id);
      return view('detail', ['item_id' => $item_id]);
    }

    public function cart(Request $request) {
      // あるユーザのカート情報を取得
      $user_id = $request->user_id;
      $item_id = $request->item_id;
      $items = Cart::where('user_id', $request->user_id)->get();
      $found = false;
      // あるユーザのカート内のitem情報を全列挙
      foreach($items as $item) {
        // もしカートに入れた商品IDと一致したら更新
        if($item->item_id == $request->item_id) {
          $found = true;
        }
      }
      // ユーザがカート情報を持っていないまたはカートに新しく入れる商品の場合は新規登録
      // それ以外は更新
      if(count($items) == 0 || $found == false) {
        // $this->createShoppingCart($user_id, $item_id);
        $cart = new Cart;
        $cart['user_id'] = $user_id;
        $cart['item_id'] = $item_id;
        $cart['quantity'] = 1;
        $cart['status'] = 1;
        dd($cart);
        $cart->save();
      } else {
        $cart = Cart::where('user_id', $user_id)->where('item_id', $item_id)->first();
        $cart['quantity'] += 1;
        $cart->save();
      }
      // return redirect()->route('cart', ['user_id'=>4]);
      return redirect()->to("cart/{$user_id}");
    }

    public function showCart($user_id) {
      // $cart = Cart::where('user_id', $user_id)->get('item_id');
      // dd($cart);
      // $array = Item::where($cart)->get();
      // dd($array['']);
      // dd($cart);
      // $cart_items = array();
      $user = Auth::user();
      // dd($cart_items);
      return view('cart')->with('user', $user);
      // return view('cart', ['item_id'=>$item_id]);
    }

    public function confirm() {
      return view('confirm');
    }

    public function done_payment() {
      return view('done_payment');
    }

}
