<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;
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
        $users = User::paginate(10);
        return view('/admin/user', compact('users'));
    }

    /** 商品一覧情報取得 */
    public function show_item() {
        $items = Item::paginate(10);
        return view('/admin/item', compact('items'));
    }

    /** 商品入出力画面取得 */
    public function show_item_load() {
        return view('/admin/item_load');
    }

    /** 月別商品情報取得 */
    public function show_earning(Request $request) {
        $selected_day = new Carbon($request->input('month'));
        $selected_year = date_format($selected_day, 'Y');
        $selected_month = date_format($selected_day, 'm');
        $orders_in_month = $this->select_earning_data($selected_day);
        $total_price = $this->order_price($orders_in_month);
        // $total_price = Order::select_order_price($selected_year, $selected_month);
        return view('/admin/earning', compact('selected_year', 'selected_month', 'total_price', 'orders_in_month'));
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
    private function order_price($order_details) {
        $total_price = 0;
        foreach ($order_details as $order_detail) {
            $total_price += $order_detail->price;
        }
        return $total_price;
    }

}
