<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;

class Item extends Model
{
  public function carts() {
    return $this->hasMany('App\Cart');
  }

  public function users() {
    return $this->belongsToMany('App\User', 'carts')->withPivot('quantity', 'status')->withTimestamps();
  }


  // public function cart() {
  //   return $this->belongsTo('App\Cart');
  // }
}
