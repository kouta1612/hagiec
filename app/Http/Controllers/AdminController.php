<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderDetail;
use Carbon\Carbon;
use App\Http\Test;
use SplFileObject;
use App\Order;
use App\Item;
use App\User;
use DB;

class AdminController extends Controller
{
    /** 管理者画面取得 */
    public function index() {
        return view('/admin/index');
    }

    /** ユーザ情報一覧 */
    public function show_user() {
        $users = User::all();
        return view('/admin/users', compact('users'));
    }

    /** 商品一覧情報取得 */
    public function show_items() {
        $items = Item::all();
        return view('/admin/items', compact('items'));
    }

    /** 月別商品情報取得 */
    public function show_earnings(Request $request) {
        $selected_day = new Carbon($request->input('month'));
        $selected_year = date_format($selected_day, 'Y');
        $selected_month = date_format($selected_day, 'm');
        $orders_in_month = $this->select_earning_data($selected_day);
        $total_price = $this->order_price($orders_in_month);
        return view('/admin/earnings', compact('selected_year', 'selected_month', 'total_price', 'orders_in_month'));
    }

    /** private */

    /** 選択日付の注文番号と注文金額を取得 */
    private function select_earning_data($selected_day) {

        $selected_year = date_format($selected_day, 'Y');
        $selected_month = date_format($selected_day, 'm');
        
        $orders_in_month = Order::select_earning_data($selected_year, $selected_month);

        return $orders_in_month;
    }

    /** 注文金額計算 */
    private function order_price($orders_in_month) {
        $total_price = 0;
        foreach ($orders_in_month as $order_in_month) {
            $total_price += $order_in_month->price;
        }
        return $total_price;
    }

}
