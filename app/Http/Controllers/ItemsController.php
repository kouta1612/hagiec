<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Cart;
use App\User;
use App\Delivery;
use App\Payment;
use App\Order;
use App\OrderDetail;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleNotification;
use Illuminate\Support\Facades\Session;


class ItemsController extends Controller
{
    public function logout() {
      Auth::logout();
      Session::flush();
      return redirect('login');
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
      return view('top', ['user_id' => $user_id, 'items' => $items, 'categories' => $categories, 'category_ids' => $category_ids, 'search_item_name' => $search_item_name]);
    }

    public function showDetail($item_id) {
      $user_id = Auth::id();
      $item = Item::find($item_id);
      $item_category_name = $item->category->name;
      return view('detail', ['user_id'=>$user_id, 'item' => $item, 'item_category_name' => $item_category_name]);
    }

    public function detail(Request $request) {
      // ログインしていなければログイン画面に遷移
      if(!Auth::check()) {
        return redirect()->to('/login');
      }
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
      return redirect()->to("cart");
    }

    public function showCart() {
      $user = Auth::user();
      $carts = $user->carts->where('status', '==', 1);
      $cart_in_items = $user->cart_in_items;
      return view('cart')->with([
        'user' => $user,
        'carts' => $carts,
        'cart_in_items' => $cart_in_items,
      ]);
    }

    public function cart(Request $request) {
      // ログインしていなければログイン画面に遷移
      if(!Auth::check()) {
        return redirect()->to('/login');
      }
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
      return redirect()->to("cart");
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
      return redirect()->to("cart");
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
      return view('confirm')->with(['user'=>$user, 'addresses' => $addresses, 'selected_address' => $selected_address, 'totalQuantity'=>$totalQuantity, 'totalPrice'=>$totalPrice, 'payment_status'=>$payment_status]);
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
      return redirect()->to("/confirm");
    }

    public function show_address_form() {
      return view('address');
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
      return redirect()->to('/confirm');
    }

    public function payment($status) {
      $user_id = Auth::id();
      $payment = Payment::all()->where('user_id', $user_id)->first();
      $payment->status = $status;
      $payment->save();
      return redirect()->to("/confirm");
    }

    public function done_payment(Request $request) {


      // $order = Order::find(1);
      // dd($order->order_details);

      $request->session()->regenerateToken();

      // $order = $user->orders();
      // dd($order);
      // $order->order_details->createMany($order_detail_arrays);


      $user = Auth::user();
      $validator = Validator::make($request->all(), [
        'delivery_date' => 'required|date_format:Y-m-d|after:now + 1day|',
      ])->validate();

      // 注文テーブルの登録
      $order = new Order;
      $order['user_id'] = $user->id;
      $order['order_time'] = new Carbon();
      $order['delivery_day'] = $request->delivery_date;
      $order['delivery_method'] = $request->payment;
      $order['delivery_to_id'] = $request->delivery_id;
      $order->save();

      // 注文明細テーブルと商品テーブルとカートテーブルの登録
      $carts = $user->carts()->where('status', '<>', 0);
      $order = $user->orders()->latest()->first();
      $order_detail_arrays = array();
      $cart_arrays = array();
      foreach($carts->get() as $cart) {
        $order_detail_arrays[] = array(
          'order_id' => $order->id,
          'item_id' => $cart->item_id,
          'payment_number' => $cart->quantity,
          'price' => $cart->item->price,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        );
        $cart_arrays[] = $cart;
        // $order_detail = new OrderDetail;
        // $order_detail['order_id'] = $order_id;
        // $order_detail['item_id'] = $cart->item_id;
        // $order_detail['payment_number'] = $cart->quantity;
        // $order_detail['price'] = $cart->item->price;
        // $order_detail->save();

        // 商品在庫数からカート内商品購入数を引いて更新
        $item = $cart->item;
        $item->stock_number -= $cart->quantity;
        $item->save();

        // カートテーブル更新
        // $cart->status = 0;
        // $cart->quantity = 0;
        // $cart->done_order_date = $request->delivery_date;
        // $cart->save();
      }
      // dd($order_detail_arrays);
      // $order = $user->orders()->latest()->first();
      $order->order_details()->insert($order_detail_arrays);

      foreach($cart_arrays as $cart_array) {
        $cart_array->status = 0;
        $cart_array->quantity = 0;
        $cart_array->done_order_date = $request->delivery_date;
      }
      $carts->update($cart_arrays);
      // メール送信
      // $delivery_day = $user->orders->last()->delivery_day;
      $delivery_day = $order->delivery_day;
      $delivery = $user->deliveries->where('status', '==', 1)->first();
      $delivery_place = $delivery->state.$delivery->city.$delivery->street.$delivery->building;
      $to = 'kouta1612world69@gmail.com';
      Mail::to($to)->send(new SampleNotification($user->name, $delivery_day, $delivery_place));

      return view('done_payment')->with('order_id', $order->id);
    }
}
