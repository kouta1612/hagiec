<?php

use Illuminate\Database\Seeder;

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
        'name' => "本"
      ]);
      DB::table('categories')->insert([
        'name' => "ゲーム"
      ]);
      DB::table('categories')->insert([
        'name' => "パソコン"
      ]);
    }
}
