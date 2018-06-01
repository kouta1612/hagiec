@extends('layouts/common')

@section('title', '商品詳細')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-3">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{$item_id->image_url}}" alt="Card image cap">
      </div>
    </div>
    <div class="col-4 offset-1">
      <h3 class="mb-3 pt-3">{{$item_id->name}}</h3>
      <p>カテゴリ：{{$item_id->category}}</p>
      <p>原産国：{{$item_id->country}}</p>
      <p>商品説明：<br>{{$item_id->description}}</p>
    </div>
    <div class="col-3 offset-1 pt-3">
      <p>価格 ¥{{$item_id->price}}</p>
      <form action="" method="post">
        <p>
          <label for="number">数量</label>
          <select class="form-control" name="number">
            @for($i = 0; $i < $item_id->stock_number; $i++)
              <option value="{{$i + 1}}">{{$i + 1}}</option>
            @endfor
          </select>
        </p>
        <button class="btn btn-primary" type="button" name="button">カートに追加</button>
      </form>
    </div>
  </div>
</div>
@endsection
