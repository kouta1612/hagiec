<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Payment;
use App\Item;
use App\Cart;
use DB;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tel'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // private $user_id;
    //
    // public function __get(User $user)

    public function carts() {
      return $this->hasMany('App\Cart');
    }

    public function items() {
      return $this->hasManyThrough('App\Item', 'App\Cart');
    }

    public function cart_in_items() {
      return $this->belongsToMany('App\Item', 'carts')->withPivot('quantity', 'status')->withTimestamps();
    }

    public function deliveries() {
      return $this->hasMany('App\Delivery');
    }

    public function payment() {
      return $this->hasOne('App\Payment');
    }

    public function orders() {
      return $this->hasMany('App\Order');
    }

}
