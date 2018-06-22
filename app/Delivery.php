<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
  protected $fillable = [
      'user_id', 'status', 'name', 'tel', 'postal_code', 'state', 'city', 'street', 'building'
  ];

  public function user() {
    return $this->belongsTo('App\User');
  }

}
