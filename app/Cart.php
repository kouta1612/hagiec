<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;

class Cart extends Model
{
    protected $fillable = ['user_id', 'item_id', 'quantity', 'status'];

    public function item() {
      $item = Item::where('id', $this->item_id)->first();
      return $item;
    }

}
