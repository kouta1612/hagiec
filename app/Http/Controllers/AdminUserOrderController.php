<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\OrderDetail;

class AdminUserOrderController extends Controller
{
    public function show($id) {
        $user = User::find($id);
        $user_orders = Order::select_user_order($id);
        return view('/admin/user_order', compact('user', 'user_orders'));
    }

    public function show_detail($user_id, $order_id) {
        $user_data = User::select_delivery_payment($user_id, $order_id);
        $order_details = OrderDetail::select_order_detail($user_id, $order_id);
        $total_price = $this->order_price($order_details);
        return view('/admin/user_order_detail', compact('user_data', 'order_details', 'total_price'));
    }

    /** private */

    /** 注文合計金額取得 */
    private function order_price($order_details) {
        $total_price = 0;
        foreach ($order_details as $order_detail) {
            $total_price += $order_detail->price * $order_detail->number;
        }
        return $total_price;
    }

}
