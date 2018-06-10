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
        'name' => "萩原孔太",
        'email' => "a@a.a",
        'password' => Hash::make('aaaaaa'),
        'tel' => "090-3241-1432",
      ]);

      DB::table('users')->insert([
        'name' => "田中太郎",
        'email' => "tanaka@gmail.com",
        'password' => Hash::make('aaaaaa'),
        'tel' => "03-3241-1432",
      ]);
      DB::table('users')->insert([
        'name' => "John",
        'email' => "john@gmail.com",
        'password' => Hash::make('aaaaaa'),
        'tel' => "03-5467-4563",
      ]);
      DB::table('users')->insert([
        'name' => "ハリー",
        'email' => "herry@gmail.com",
        'password' => Hash::make('aaaaaa'),
        'tel' => "03-5467-4563",
      ]);
    }
}
