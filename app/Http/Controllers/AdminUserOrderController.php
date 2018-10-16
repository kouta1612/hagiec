<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;

class AdminUserOrderController extends Controller
{
    public function show($id) {
        $user = User::find($id);
        $user_orders = Order::select_user_order($id);
        return view('/admin/user_order', compact('user', 'user_orders'));
    }

    public function show_detail($user_id, $order_id) {
        $order_details = OrderDetail::select_order_detail($user_id, $order_id);

    }
}
