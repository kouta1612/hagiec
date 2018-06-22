<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'item_id', 'quantity', 'status'];

    public function user() {
      return $this->belongsTo('App\User');
    }

    // public function item() {
    //   return $this->belongsTo('App\Item','item_id', 'id');
    // }

    public function item() {
     return $this->belongsTo('App\Item');
   }

    // public function items() {
    //   return $this->hasOne('App\Item');
    // }

    // public function item() {
    //   $item = Item::where('id', $this->item_id)->first();
    //   return $item;
    // }

}
