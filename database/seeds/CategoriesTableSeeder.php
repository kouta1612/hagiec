<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert([
        'name' => "本",
        'created_at' => new Carbon(),
        'updated_at' => new Carbon(),
      ]);
      DB::table('categories')->insert([
        'name' => "ゲーム",
        'created_at' => new Carbon(),
        'updated_at' => new Carbon(),
      ]);
      DB::table('categories')->insert([
        'name' => "パソコン",
        'created_at' => new Carbon(),
        'updated_at' => new Carbon(),
      ]);
    }
}
