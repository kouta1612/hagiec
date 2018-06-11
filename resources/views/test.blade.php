@extends('layouts/common')

@section('title', '決済確認画面')

@section('content')
<div class="container">
  <div class="row">
    <form id="form1" class="form-group" action="index" method="post">
      <form id="form2" class="form-group" action="show" method="post">
        <input type="text" name="name">
        <input type="submit" value="送信">
      </form>
      <input type="email" name="email">
      <input type="submit" value="送信">
    </form>
  </div>
</div>
@endsection

@section('jQuery')
<script>

</script>
@endsection
