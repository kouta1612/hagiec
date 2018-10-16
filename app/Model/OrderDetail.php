<?php

namespace App;

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
    public function select_order_detail($user_id, $order_id) {
      $order_details = 
    }

}
