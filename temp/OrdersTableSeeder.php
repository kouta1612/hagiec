<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
          'user_id' => "8",
          'order_time' => "2018-5-21 18:00:00",
          'delivery_day' => "3",
          'delivery_method' => "クレジットカード",
          'delivery_to_id' => "1"
        ]);

        DB::table('orders')->insert([
          'user_id' => "8",
          'order_time' => "2018-5-21 20:00:00",
          'delivery_day' => "2",
          'delivery_method' => "現金",
          'delivery_to_id' => "2"
        ]);

        DB::table('orders')->insert([
          'user_id' => "9",
          'order_time' => "2018-5-21 18:00:00",
          'delivery_day' => "3",
          'delivery_method' => "現金",
          'delivery_to_id' => "1"
        ]);
    }
}
