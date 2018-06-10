<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
  protected $fillable = [
      'user_id', 'name', 'tel', 'postal_code', 'state', 'city', 'street', 'building'
  ];
}
