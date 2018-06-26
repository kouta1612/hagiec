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

}
