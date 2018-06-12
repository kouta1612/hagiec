@extends('layouts/common')
@section('title', '注文完了画面')

@section('content')
<div class="container text-center">
  <div class="row">
    <div class="col mb-5">
      <h3>ご注文ありがとうございました</h3>
      <p>確認のEメールを送信しました。</p>
    </div>
  </div>
  <div class="row">
    <div class="col mb-5">
      <h3>注文番号：2356195619</h3>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <a href="/top" class="btn btn-primary">トップに戻る</a>
    </div>
  </div>
</div>
@endsection
