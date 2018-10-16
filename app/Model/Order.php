<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    public function user() {
      return $this->belongsTo('App\User');
    }

    public function order_details() {
      return $this->hasMany('App\OrderDetail');
    }

    /** 注文詳細情報取得 */
    public static function select_earning_detail($id) {
      $earning_detail_datas = Order::select('od.id as id', 'i.name as name', 'od.price as price', 'od.payment_number as number')
        ->selectRaw('od.price * od.payment_number as total_price')
        ->from('orders as o')
        ->join('order_details as od', 'o.id', '=', 'od.order_id')
        ->join('items as i', 'i.id', '=', 'od.item_id')
        ->where('o.id', '=', $id)
        ->get();
      return $earning_detail_datas;
    }

    /** 選択日付の注文番号と注文金額を取得 */
    public static function select_earning_data($selected_year, $selected_month) {
      $sub = Order::select('o.id as id', 'o.order_time as order_time')
        ->selectRaw('od.payment_number * i.price as p')
        ->from('orders as o')
        ->join('order_details as od', 'o.id', '=', 'od.order_id')
        ->join('items as i', 'od.item_id', '=', 'i.id')
        ->toSql();

      $orders_in_month = DB::table(DB::raw("({$sub}) as sub"))
        ->select('sub.id as id')
        ->selectRaw('sum(sub.p) as price')
        ->whereYear('sub.order_time', '=', $selected_year)
        ->whereMonth('sub.order_time', '=', $selected_month)
        ->groupBy('sub.id')
        ->get();
      
      return $orders_in_month;
    }

    /** ユーザの注文金額を取得 */
    public static function select_user_order_price($id) {

      $sub = Order::select('o.id as id')
        ->selectRaw('sum(od.payment_number * i.price) as order_price')
        ->from('orders as o')
        ->join('order_details as od', 'o.id', '=', 'od.order_id')
        ->join('items as i', 'od.item_id', '=', 'i.id')
        ->groupBy('o.id')
        ->toSql();

      $user_orders = DB::table(DB::raw("({$sub}) as sub"))
        ->join('orders as o', 'sub.id', '=', 'o.id')
        ->select('o.id', 'o.order_time', 'o.delivery_day', 'o.delivery_method', 'sub.order_price')
        ->get();

      return $user_orders;
    }

}
