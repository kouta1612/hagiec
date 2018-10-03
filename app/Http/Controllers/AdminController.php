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

    public function show_earning(Request $request) {

        /* 月別の商品をすべて取得 */
        /*$orders_in_month = Order::all();*/

        $today = new Carbon();
        $year = date_format($today, 'Y');
        $month = date_format($today, 'm');
        $selected_day = new Carbon($request->input('month'));
        $selected_year = date_format($selected_day, 'Y');
        $selected_month = date_format($selected_day, 'm');

        $orders_in_month = DB::table('orders')
            ->select(DB::raw('sum(items.price) as price, orders.id as id'))
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('items', 'order_details.item_id', '=', 'items.id');
        
        if($request->has('month')) {
            echo 1;
            $orders_in_month = $orders_in_month
                ->whereYear('orders.order_time', '=', $selected_year)
                ->whereMonth('orders.order_time', '=', $selected_month)
                ->groupBy('orders.id')
                ->get();
            
            /*
            $orders_in_month = DB::table('orders')
            ->select(DB::raw('sum(items.price) as price, orders.id as order_id'))
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('items', 'order_details.item_id', '=', 'items.id')
            ->whereYear('orders.order_time', '=', $selected_year)
            ->whereMonth('orders.order_time', '=', $selected_month)
            ->groupBy('orders.id')
            ->get();
            */
        } else {
            echo 2;
            $orders_in_month = $orders_in_month
                ->whereYear('orders.order_time', '=', $year)
                ->whereMonth('orders.order_time', '=', $month)
                ->groupBy('orders.id')
                ->get();
        }
        return view('/admin/earnings', compact('orders_in_month'));
        /*return view('/admin/earnings', ['orders_in_month' => $orders_in_month]);*/
    }

}
