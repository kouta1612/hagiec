<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;
use DB;

class Item extends Model
{
  public function carts() {
    return $this->hasMany('App\Cart');
  }

  public function users() {
    return $this->belongsToMany('App\User', 'carts')->withPivot('quantity', 'status')->withTimestamps();
  }

  public function category() {
    return $this->belongsTo('App\Category');
  }

  public function order_details() {
    return $this->hasMany('App\Order_detail');
  }

  // 商品テーブル更新
  public static function truncate_insert($csv) {
    DB::beginTransaction();
    try {
        DB::table('items')->truncate();
        foreach(array_chunk($csv, 1000) as $data) {
            DB::table('items')->insert($data);
        }
        DB::commit();
    } catch(Exception $e) {
        DB::rollBack();
    }
  }

}
