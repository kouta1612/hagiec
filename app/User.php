<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Item;
use App\Payment;

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
        'password', 'remember_token'
    ];

    // private $user_id;
    //
    // public function __get(User $user)

    public function carts() {
      $carts = Cart::where('user_id', $this->id)->where('status', 1)->get();
      return $carts;
    }

    public function addresses() {
      $addresses = Delivery::where('user_id', $this->id)->get();
      return $addresses;
    }

    public function selected_address() {
      $addresses = Delivery::where('user_id', $this->id)->where('status', 1)->first();
      return $addresses;
    }

    public function totalQuantity() {
      $totalQuantity = 0;
      foreach($this->carts() as $cart) {
        $totalQuantity += $cart->quantity;
      }
      return $totalQuantity;
    }

    public function totalPrice() {
      $totalPrice = 0;
      foreach($this->carts() as $cart) {
        $itemPrice = Item::where('id', $cart->item_id)->first()->price;
        $totalPrice += $itemPrice * $cart->quantity;
      }
      return $totalPrice;
    }

    public function selectUser() {
      $user = User::where('id', $this->id)->first();
      return $user;
    }

    public function payment_status() {
      $payment = Payment::all()->where('user_id', $this->id)->first();
      return $payment;
    }


}
