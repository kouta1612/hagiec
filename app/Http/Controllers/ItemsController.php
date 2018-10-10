<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleNotification;
use Illuminate\Http\Request;
use App\OrderDetail;
use Carbon\Carbon;
use App\Delivery;
use App\Category;
use App\Payment;
use Validator;
use App\Order;
use App\Item;
use App\Cart;
use App\User;
use DB;

class ItemsController extends Controller
{
    public function logout() {
      Auth::logout();
      Session::flush();
      return redirect('/login');
    }

    public function top(Request $request) {
      $search_item_name = $request->search_item_name;
      $category_ids = $request->category;
      $items = Item::where('stock_number', '<>', 0);
      if(!empty($search_item_name) && isset($category_ids)) {
        $items->where('name', 'like', '%'.$search_item_name.'%')->whereIn('category_id', $category_ids);
      } else if(!empty($search_item_name)) {
        $items->where('name', 'like', '%'.$search_item_name.'%');
      } else if(isset($category_ids)) {
        $items->whereIn('category_id', $category_ids);
      }
      $items = $items->get();
      $user_id = Auth::id();
      $categories = Category::all();
      return view('/user/top')->with([
        'user_id' => $user_id,
        'items' => $items,
        'categories' => $categories,
        'category_ids' => $category_ids,
        'search_item_name' => $search_item_name,
      ]);
    }

    public function showDetail($item_id) {
      $user_id = Auth::id();
      $item = Item::find($item_id);
      $item_category_name = $item->category->name;
      return view('/user/detail')->with([
        'user_id'=>$user_id,
        'item' => $item,
        'item_category_name' => $item_category_name,
      ]);
    }

    public function showCart() {
      $user = Auth::user();
      $carts = $user->carts->where('status', '==', 1);
      $cart_in_items = $user->cart_in_items->sortByDesc('updated_at');
      return view('/user/cart')->with([
        'user' => $user,
        'carts' => $carts,
        'cart_in_items' => $cart_in_items,
      ]);
    }

    public function cart(Request $request) {
      // ログインしていなければログイン画面に遷移
      if(!Auth::check()) {
        return redirect('/login');
      }
      dd($request);
      // あるユーザのカート情報を取得
      $user_id = $request->user_id;
      $item_id = $request->item_id;
      $items = Cart::where('user_id', $user_id)->get();
      $found = false;

      // あるユーザのカート内のitem情報を全列挙
      foreach($items as $item) {
        // もしカートに入れた商品IDと一致したら更新
        if($item->item_id == $item_id) {
          $found = true;
        }
      }
      // ユーザがカート情報を持っていないまたはカートに新しく入れる商品の場合は新規登録
      // それ以外は更新
      if(count($items) == 0 || $found == false) {
        $cart = new Cart;
        $cart['user_id'] = $user_id;
        $cart['item_id'] = $item_id;
        $cart['quantity'] = 1;
        $cart['status'] = 1;
        $cart->save();
      } else {
        $cart = Cart::where('user_id', $user_id)->where('item_id', $item_id)->first();
        $cart['quantity'] += 1;
        $cart['status'] = 1;
        $cart->save();
      }
      return redirect('/cart');
    }

    public function ajax_cart(Request $request) {
      $user_id = $request->user_id;
      $item_id = $request->item_id;
      $item = Cart::where('user_id', $user_id)->where('item_id', $item_id)->first();
      $item->quantity = $request->quantity;
      $item->save();
      return $item;
    }

    public function destroy($item_id) {
      $user_id = Auth::id();
      $deleteItem = Cart::where('user_id', $user_id)->where('item_id', $item_id)->first();
      $deleteItem->delete();
      return redirect('/cart');
    }

    public function confirm(Request $request) {
      $user = Auth::user();
      $addresses = $user->deliveries->where('user_id', $user->id);
      $selected_address = $addresses->where('user_id', $user->id)->where('status', 1)->first();
      $totalQuantity = 0;
      $totalPrice = 0;
      // カート内商品数と小計を計算
      foreach($user->cart_in_items as $cart_in_item) {
        $totalQuantity += $cart_in_item->pivot->quantity;
        $itemPrice = $cart_in_item->price;
        $quantity = $cart_in_item->pivot->quantity;
        $totalPrice += $itemPrice * $quantity;
      }
      $payment_status = $request->payment_status;
      return view('/user/confirm')->with([
        'user'=>$user,
        'addresses' => $addresses,
        'selected_address' => $selected_address,
        'totalQuantity'=>$totalQuantity,
        'totalPrice'=>$totalPrice,
        'payment_status'=>$payment_status
      ]);
    }

    public function select_address(Request $request) {
      $id = $request->id;
      $user_id = Auth::id();
      $addresses = Delivery::all()->where('user_id', $user_id);
      $selected_address = Delivery::find($id);
      foreach($addresses as $address) {
        if($address->status == 1) {
          if($address->id != $selected_address->id) {
            $selected_address->status = 1;
            $address->status = 0;
            $selected_address->save();
            $address->save();
            break;
          }
        }
      }
      return redirect('/user/confirm');
    }

    public function show_address_form() {
      return view('/user/address');
    }

    public function post_address(Request $request) {
      $delivery = new Delivery;
      $user_id = Auth::id();
      $delivery['user_id'] = $user_id;
      $delivery['status'] = 0;
      $delivery['name'] = $request->name;
      $delivery['postal_code'] = $request->postal_code;
      $delivery['state'] = $request->state;
      $delivery['city'] = $request->city;
      $delivery['street'] = $request->street;
      $delivery['building'] = $request->building;
      $delivery['tel'] = $request->tel;
      $delivery->save();
      $request->session()->regenerateToken();
      return redirect('/confirm');
    }

    public function payment($status) {
      $user_id = Auth::id();
      $payment = Payment::all()->where('user_id', $user_id)->first();
      $payment->status = $status;
      $payment->save();
      return redirect('/confirm');
    }

    public function done_payment(Request $request) {

      $request->session()->regenerateToken();

      $user = Auth::user();
      $updated_at = new Carbon();

      $validator = Validator::make($request->all(), [
        'delivery_date' => 'required|date_format:Y-m-d|after:now + 1day|',
      ])->validate();

      // 注文テーブルの登録
      $order = new Order;
      $order['user_id'] = $user->id;
      $order['order_time'] = $updated_at;
      $order['delivery_day'] = $request->delivery_date;
      $order['delivery_method'] = $request->payment;
      $order['delivery_to_id'] = $request->delivery_id;
      $order->save();

      // 注文明細テーブルと商品テーブルとカートテーブルの登録・更新準備
      $carts = $user->carts()->where('status', '<>', 0);
      $cart_in_items = $user->cart_in_items()->where('status', '<>', 0)->get();
      $order = $user->orders()->latest()->first();
      $order_detail_arrays = array();
      $cases = [];
      $ids = [];
      $params = [];
      foreach($carts->get() as $id => $cart) {
        $order_detail_arrays[] = array(
          'order_id' => $order->id,
          'item_id' => $cart->item_id,
          'payment_number' => $cart->quantity,
          'price' => $cart_in_items[$id]->price,
          'created_at' => $updated_at,
          'updated_at' => $updated_at,
        );
        $new_stock_number = $cart_in_items[$id]->stock_number - $cart->quantity;
        $cases[] = "when id = {$cart->item_id} then {$new_stock_number}";
        $ids[] = $cart->item_id;
      }

      // 注文明細テーブルと商品テーブルとカートテーブルの登録・更新処理
      $order->order_details()->insert($order_detail_arrays);
      $carts->update([
        'quantity' => 0,
        'status' => 0,
        'updated_at' => $updated_at,
      ]);
      $cases = implode(' ', $cases);
      $ids = implode(',', $ids);
      DB::update("update items set stock_number = case {$cases} end, updated_at = '{$updated_at}' WHERE id in ({$ids})");

      // メール送信
      $delivery_day = $order->delivery_day;
      $delivery = $user->deliveries->where('status', '==', 1)->first();
      $delivery_place = $delivery->state.$delivery->city.$delivery->street.$delivery->building;
      $to = 'kouta1612world69@gmail.com';
      Mail::to($to)->send(new SampleNotification($user->name, $delivery_day, $delivery_place));
      return view('/user/done_payment')->with('order_id', $order->id);
    }

}
