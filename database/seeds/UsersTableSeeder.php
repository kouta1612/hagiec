<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      DB::table('users')->insert([
        'name' => "田中太郎",
        'email' => "tanaka@gmail.com",
        'password' => Hash::make('aaaaaa'),
        'tel' => "03-3241-1432",
        'state' => "東京都",
        'city' => "渋谷区",
        'street' => "1-6-6",
        'building' => "渋谷ハイツ",
        'postal_code' => "150-0011"
      ]);

      DB::table('users')->insert([
        'name' => "田中太郎",
        'email' => "tanaka@gmail.com",
        'password' => Hash::make('aaaaaa'),
        'tel' => "03-3241-1432",
        'state' => "東京都",
        'city' => "渋谷区",
        'street' => "1-6-6",
        'building' => "渋谷ハイツ",
        'postal_code' => "150-0011"
      ]);
      DB::table('users')->insert([
        'name' => "John",
        'email' => "john@gmail.com",
        'password' => Hash::make('aaaaaa'),
        'tel' => "03-5467-4563",
        'state' => "アメリカ",
        'city' => "カリフォルニア",
        'street' => "1-6-6",
        'building' => "アメリカンハウス",
        'postal_code' => "453-3453"
      ]);
      DB::table('users')->insert([
        'name' => "ハリー",
        'email' => "herry@gmail.com",
        'password' => Hash::make('aaaaaa'),
        'tel' => "03-5467-4563",
        'state' => "アメリカ",
        'city' => "カリフォルニア",
        'street' => "1-6-6",
        'building' => "アメリカンハウス",
        'postal_code' => "546-3453"
      ]);
    }
}
