@extends('layouts.default')

@section('title', 'ログイン')

@section('content')
<form action="" method="post" name="Login_Form" class="form-signin">
  <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
  <hr class="colorgraph"><br>

  <input type="text" class="form-control" name="Username" placeholder="Email" required="" autofocus="">
  <input type="password" class="form-control" name="password" placeholder="Password" required="">

  <button class="btn btn-lg btn-primary btn-block" name="Submit" value="Sign In" type="submit">Sign In</button>
</form>
@endsection
