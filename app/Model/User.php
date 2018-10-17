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

    /** ユーザのお届け先情報と決済情報の取得 */
    public static function select_delivery_payment($user_id, $order_id) {
      $user_data = DB::table('users as u')
        ->select('p.status as status', 'd.name as name', 'd.tel as tel', 'd.postal_code as postal_code', 'd.state as state', 'd.city as city', 'd.street as street', 'd.building as building')
        ->join('payments as p', 'u.id', '=', 'p.user_id')
        ->join('orders as o', 'u.id', '=', 'o.user_id')
        ->join('deliveries as d', 'u.id', '=', 'd.user_id')
        ->where('u.id', '=', $user_id)
        ->where('o.id', '=', $order_id)
        ->first();

      return $user_data;
    }

}
