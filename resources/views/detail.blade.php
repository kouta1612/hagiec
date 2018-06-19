@extends('layouts/common')

@section('title', '商品詳細')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-3">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{$item->image_url}}" alt="Card image cap">
      </div>
    </div>
    <div class="col-4 offset-1">
      <h3 class="mb-3 pt-3">{{$item->name}}</h3>
      <p>カテゴリ：{{$item_category_name}}</p>
      <p>原産国：{{$item->country}}</p>
      <p>商品説明：<br>{{$item->description}}</p>
    </div>
    <div class="col-3 offset-1 pt-3">
      <h3 class="mb-5">¥{{$item->price}}</h3>
      <form class="form-group" action="/detail" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="item_id" value="{{$item->id}}">
        <button class="btn btn-primary" type="submit">カートに追加</button>
      </form>
    </div>
  </div>
</div>
@endsection

@section('jQuery')
<script>
$(function() {
  $(':submit').click(function (event) {
  var TIMEOUT = 10000;
  var target  = event.target;
  var $form   = $(target).closest('form');
  var $submit = $form.find(':submit');

  // clickしたsubmitの値をhiddenに保存
  var $hidden = $('<input/>', {
    type: 'hidden',
    name: target.name,
    value: target.value
  }).appendTo($form);

  event.preventDefault();
  event.stopPropagation();

  // 全てのsubmitを無効化
  $submit.prop('disabled', true);

  // 時間経過でsubmitの無効化を解除
  setTimeout(function () {
    $hidden.remove();
    $submit.prop('disabled', false);
  }, TIMEOUT);

  $form.submit();
});
});
</script>
@endsection
