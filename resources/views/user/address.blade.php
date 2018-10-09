@extends('layouts/common')

@section('title', 'お届け先住所登録')

@section('content')

<div class="container">
  <h3 class="mb-4">お届け先情報登録</h3>
  <form action="/address" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="name">氏名</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="田中太郎">
    </div>
    <div class="form-group">
      <label for="postal_code">郵便番号</label>
      <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="120-0013">
    </div>
    <div class="form-group">
      <label for="state">お届け先住所(都道府県)</label>
      <input type="text" class="form-control" name="state" id="state" placeholder="東京都">
    </div>
    <div class="form-group">
      <label for="city">お届け先住所(市区町村)</label>
      <input type="text" class="form-control" name="city" id="city" placeholder="渋谷区">
    </div>
    <div class="form-group">
      <label for="street">お届け先住所(番地)</label>
      <input type="text" class="form-control" name="street" id="street" placeholder="笹塚 2-43-1">
    </div>
    <div class="form-group">
      <label for="building">お届け先住所(建物名)</label>
      <input type="text" class="form-control" name="building" id="building" placeholder="建物ハイツ301号室">
    </div>
    <div class="form-group">
      <label for="tel">電話番号</label>
      <input type="text" class="form-control" name="tel" id="tel" placeholder="090-2342-2352">
    </div>
    <button type="submit" class="btn btn-primary mb-5 mt-2">登録</button>
  </form>
</div>
@endsection
