<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
          'name' => "Switch",
          'price' => 32000,
          'category_id' => 2,
          'country' => "日本",
          'description' => "シーンに合わせてカタチを変えるゲーム機「Nintendo Switch」",
          'delivery_date' => "3",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/61LB0JRyb9L._SL1063_.jpg",
          'stock_number' => 10,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "リーダブルコード",
          'price' => 2500,
          'category_id' => 1,
          'country' => "日本",
          'description' => "美しいコードを見ると感動する。優れたコードは見た瞬間に何をしているかが伝わってくる。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/51MgH8Jmr3L._SX352_BO1,204,203,200_.jpg",
          'stock_number' => 24,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "デザインパターン入門 ",
          'price' => 4000,
          'category_id' => 1,
          'country' => "日本",
          'description' => "GoFの『デザインパターン』で紹介された23個のパターンを、オブジェクト指向の初心者にもわかるようにやさしく解説。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/51QsmvkObML._SX392_BO1,204,203,200_.jpg",
          'stock_number' => 30,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "iMac",
          'price' => 196670,
          'category_id' => 3,
          'country' => "日本",
          'description' => "新しいiMacは、まったく新しいプロセッサ、最新のグラフィックテクノロジー、革新的なストレージ、帯域幅が広がった接続機能など、あらゆる驚きが満載。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/513p5lsxbTL._SX425_.jpg",
          'stock_number' => 99,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "Switch",
          'price' => 32000,
          'category_id' => 2,
          'country' => "日本",
          'description' => "シーンに合わせてカタチを変えるゲーム機「Nintendo Switch」",
          'delivery_date' => "3",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/61LB0JRyb9L._SL1063_.jpg",
          'stock_number' => 10,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "リーダブルコード",
          'price' => 2500,
          'category_id' => 1,
          'country' => "日本",
          'description' => "美しいコードを見ると感動する。優れたコードは見た瞬間に何をしているかが伝わってくる。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/51MgH8Jmr3L._SX352_BO1,204,203,200_.jpg",
          'stock_number' => 24,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "デザインパターン入門 ",
          'price' => 4000,
          'category_id' => 1,
          'country' => "日本",
          'description' => "GoFの『デザインパターン』で紹介された23個のパターンを、オブジェクト指向の初心者にもわかるようにやさしく解説。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/51QsmvkObML._SX392_BO1,204,203,200_.jpg",
          'stock_number' => 30,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "iMac",
          'price' => 196670,
          'category_id' => 3,
          'country' => "日本",
          'description' => "新しいiMacは、まったく新しいプロセッサ、最新のグラフィックテクノロジー、革新的なストレージ、帯域幅が広がった接続機能など、あらゆる驚きが満載。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/513p5lsxbTL._SX425_.jpg",
          'stock_number' => 99,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "Switch",
          'price' => 32000,
          'category_id' => 2,
          'country' => "日本",
          'description' => "シーンに合わせてカタチを変えるゲーム機「Nintendo Switch」",
          'delivery_date' => "3",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/61LB0JRyb9L._SL1063_.jpg",
          'stock_number' => 10,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "リーダブルコード",
          'price' => 2500,
          'category_id' => 1,
          'country' => "日本",
          'description' => "美しいコードを見ると感動する。優れたコードは見た瞬間に何をしているかが伝わってくる。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/51MgH8Jmr3L._SX352_BO1,204,203,200_.jpg",
          'stock_number' => 24,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "デザインパターン入門 ",
          'price' => 4000,
          'category_id' => 1,
          'country' => "日本",
          'description' => "GoFの『デザインパターン』で紹介された23個のパターンを、オブジェクト指向の初心者にもわかるようにやさしく解説。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/51QsmvkObML._SX392_BO1,204,203,200_.jpg",
          'stock_number' => 30,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "iMac",
          'price' => 196670,
          'category_id' => 3,
          'country' => "日本",
          'description' => "新しいiMacは、まったく新しいプロセッサ、最新のグラフィックテクノロジー、革新的なストレージ、帯域幅が広がった接続機能など、あらゆる驚きが満載。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/513p5lsxbTL._SX425_.jpg",
          'stock_number' => 99,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "Switch",
          'price' => 32000,
          'category_id' => 2,
          'country' => "日本",
          'description' => "シーンに合わせてカタチを変えるゲーム機「Nintendo Switch」",
          'delivery_date' => "3",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/61LB0JRyb9L._SL1063_.jpg",
          'stock_number' => 10,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "リーダブルコード",
          'price' => 2500,
          'category_id' => 1,
          'country' => "日本",
          'description' => "美しいコードを見ると感動する。優れたコードは見た瞬間に何をしているかが伝わってくる。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/51MgH8Jmr3L._SX352_BO1,204,203,200_.jpg",
          'stock_number' => 24,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "デザインパターン入門 ",
          'price' => 4000,
          'category_id' => 1,
          'country' => "日本",
          'description' => "GoFの『デザインパターン』で紹介された23個のパターンを、オブジェクト指向の初心者にもわかるようにやさしく解説。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/51QsmvkObML._SX392_BO1,204,203,200_.jpg",
          'stock_number' => 30,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "iMac",
          'price' => 196670,
          'category_id' => 3,
          'country' => "日本",
          'description' => "新しいiMacは、まったく新しいプロセッサ、最新のグラフィックテクノロジー、革新的なストレージ、帯域幅が広がった接続機能など、あらゆる驚きが満載。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/513p5lsxbTL._SX425_.jpg",
          'stock_number' => 99,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "Switch",
          'price' => 32000,
          'category_id' => 2,
          'country' => "日本",
          'description' => "シーンに合わせてカタチを変えるゲーム機「Nintendo Switch」",
          'delivery_date' => "3",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/61LB0JRyb9L._SL1063_.jpg",
          'stock_number' => 10,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "リーダブルコード",
          'price' => 2500,
          'category_id' => 1,
          'country' => "日本",
          'description' => "美しいコードを見ると感動する。優れたコードは見た瞬間に何をしているかが伝わってくる。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/51MgH8Jmr3L._SX352_BO1,204,203,200_.jpg",
          'stock_number' => 24,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "デザインパターン入門 ",
          'price' => 4000,
          'category_id' => 1,
          'country' => "日本",
          'description' => "GoFの『デザインパターン』で紹介された23個のパターンを、オブジェクト指向の初心者にもわかるようにやさしく解説。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/51QsmvkObML._SX392_BO1,204,203,200_.jpg",
          'stock_number' => 30,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
        DB::table('items')->insert([
          'name' => "iMac",
          'price' => 196670,
          'category_id' => 3,
          'country' => "日本",
          'description' => "新しいiMacは、まったく新しいプロセッサ、最新のグラフィックテクノロジー、革新的なストレージ、帯域幅が広がった接続機能など、あらゆる驚きが満載。",
          'delivery_date' => "1",
          'image_url' => "https://images-na.ssl-images-amazon.com/images/I/513p5lsxbTL._SX425_.jpg",
          'stock_number' => 99,
          'created_at' => new Carbon(),
          'updated_at' => new Carbon(),
        ]);
    }
}
