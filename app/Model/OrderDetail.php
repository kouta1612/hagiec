<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    protected $fillable = [
      'order_id', 'item_id', 'payment_number', 'price',
    ];

    public function order() {
      return $this->belongsTo('App\Order');
    }

    public function items() {
      return $this->hasMany('App\item');
    }

    /** ユーザの注文詳細情報を取得 */
    // 注文明細IDと商品名と単価と購入数と合計金額
    public static function select_order_detail($user_id, $order_id) {
      $order_details = DB::table('order_details as od')
        ->select('od.id as id', 'i.name as name', 'od.payment_number as number')
        ->selectRaw('i.price as price')
        ->selectRaw('i.price * od.payment_number as total_price')
        ->join('orders as o', 'od.order_id', '=', 'o.id')
        ->join('users as u', 'o.user_id', '=', 'u.id')
        ->join('items as i', 'od.item_id', '=', 'i.id')
        ->where('u.id', '=', $user_id)
        ->where('o.id', '=', $order_id)
        ->get();

      return $order_details;
    }

}
