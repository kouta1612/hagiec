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

class ItemsController extends Controller
{
    public function logout() {
      Auth::logout();
      return redirect('login');
    }

    public function top(Request $request) {
      $search_item_name = $request->search_item_name;
      $category_ids = $request->category;
      if(!empty($search_item_name) && isset($category_ids)) {
        $items = Item::where('name', 'like', '%'.$search_item_name.'%')->whereIn('category_id', $category_ids)->get();
      } else if(!empty($search_item_name)) {
        $items = Item::where('name', 'like', '%'.$search_item_name.'%')->get();
      } else if(isset($category_ids)) {
        $items = Item::whereIn('category_id', $category_ids)->get();
      } else {
        $items = Item::all();
      }
      $user_id = Auth::id();
      $categories = Category::all();
      return view('top', ['user_id' => $user_id, 'items' => $items, 'categories' => $categories, 'category_ids' => $category_ids, 'search_item_name' => $search_item_name]);
    }

    public function showDetail($id) {
      $user_id = Auth::id();
      $item = Item::find($id);
      return view('detail', ['user_id'=>$user_id, 'item' => $item]);
    }

    public function detail(Request $request) {
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
      return redirect()->to("cart/{$user_id}");
    }

    public function showCart($user_id) {
      $user = Auth::user();
      return view('cart')->with('user', $user);
    }

    public function cart(Request $request) {
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

      return redirect()->to("cart/{$user_id}");
    }

    public function destroy($item_id) {
      $user_id = Auth::id();
      $deleteItem = Cart::where('user_id', $user_id)->where('item_id', $item_id)->first();
      $deleteItem->delete();
      return redirect()->to("cart/{$user_id}");
    }

    public function confirm($user_id, Request $request) {
      $user = Auth::user();
      $totalQuantity = $request->totalQuantity;
      $totalPrice = $request->totalPrice;
      $payment_status = $request->payment_status;
      return view('confirm')->with(['user'=>$user, 'user_id'=>$user_id, 'totalQuantity'=>$totalQuantity, 'totalPrice'=>$totalPrice, 'payment_status'=>$payment_status]);
    }

    public function select_address(Request $request) {
      $id = $request->id;
      $addresses = Delivery::all();
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
      return redirect()->to("/confirm/{$selected_address->user_id}");
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
      return redirect()->to('/confirm/{$user_id}');
    }

    public function payment($status) {
      $user_id = Auth::id();
      $payment = Payment::all()->where('user_id', $user_id)->first();
      $payment->payment_status = $status;
      $payment->save();
      return redirect()->to("/confirm/{$user_id}");
    }

    public function done_payment(Request $request) {
      $user_id = Auth::id();

      // 注文テーブルの更新
      $order = new Order;
      $order['user_id'] = $user_id;
      $order['order_time'] = new Carbon();
      $order['delivery_day'] = $request->delivery_date;
      $order['delivery_method'] = $request->payment;
      $order['delivery_to_id'] = $request->delivery_id;
      $order->save();

      $user = User::where('id', $user_id)->first();
      $carts = $user->carts();

      // 注文明細テーブルと商品テーブルとカートテーブルの登録
      foreach($carts as $cart) {
        $order_detail = new OrderDetail;
        $order_detail['order_id'] = Order::orderBy('id', 'desc')->first()->id;
        $order_detail['item_id'] = $cart->item_id;
        $order_detail['payment_number'] = $cart->quantity;
        $order_detail['price'] = Item::where('id', $cart->item_id)->first()->price;
        $order_detail->save();

        // 商品在庫数からカート内商品購入数を引いて更新
        $item = Item::where('id', $cart->item_id)->first();
        $item->stock_number -= $cart->quantity;
        $item->save();

        // カート内商品のステータスと購入数を0にする
        //　購入数は登録後に更新
        $cart->status = 0;
        $cart->save();
        $cart->quantity = 0;
        $cart->save();
      }

      return view('done_payment');
    }

}
