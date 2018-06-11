<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Delivery;
use App\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

      $user_id = DB::table('users')->orderBy('id', 'desc')->value('id') + 1;

      Delivery::create([
        'user_id' => $user_id,
        'status' => 1,
        'name' => $data['name'],
        'tel' => $data['tel'],
        'postal_code' => $data['postal_code'],
        'state' => $data['state'],
        'city' => $data['city'],
        'street' => $data['street'],
        'building' => $data['building']
      ]);

      Payment::create([
        'user_id' => $user_id,
        'payment_status' => 0
      ]);

      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'tel' => $data['tel'],
        'payment_status' => 0
      ]);

    }
}
