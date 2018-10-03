<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use DB;

class AdminController extends Controller
{
    public function index() {
        $date = new Carbon();
        echo date_format(new Carbon(), 'Y-m');
        return view('/admin/index');
    }

    public function show_earning($request) {

        /** 月別の商品をすべて取得 */
        /**$orders_in_month = Order::all();**/

        if($request->has('month')) {
            $orders_in_month = DB::table('orders')
            ->select(DB::raw('sum(items.price)'))
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('items', 'order_details.item_id', '=', 'items.id')
            ->where(DB::raw('DATE_FORMAT(orders.order_time, %Y%m) = date_format(new Carbon(), Y-m)')
            ->groupBy('orders.id');
        } 
        

        return view('/admin/earnings', compact('orders_in_month'));
        
    }

}
