<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;

class AdminUserOrderController extends Controller
{
    public function show($id) {
        $user = User::find($id);
        // $user_orders = $user->orders()->get();
        $user_orders = Order::select_user_order_price($id);
        return view('/admin/user_order', compact('user', 'user_orders'));
    }
}
