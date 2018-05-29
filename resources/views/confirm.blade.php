@extends('layouts/common')

@section('title', '決済確認画面')

@section('content')
<div class="container">
  <div class="row">
    <button type="button" class="btn btn-primary mb-5 ">注文確定</button>
  </div>
  <div class="row">
    <div class="col">
      <div class="card-header">
        注文内容
      </div>
      <div class="card-body">
        <ul class="list-group">
          <li class="list-group-item">商品数 1点</li>
          <li class="list-group-item">小計 ¥ooo,ooo</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card-header">
        お届け先住所
      </div>
      <div class="card-body">
        <ul class="list-group">
          <li class="list-group-item">名前 ベンジョンソン</li>
          <li class="list-group-item">住所 東京都渋谷区笹塚1-11-1</li>
        </ul>
      </div>
  </div>
</div>
@endsection
