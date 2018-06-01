@extends('layouts/common')

@section('title', 'カート画面')

@section('content')
<div class="container">
  <div class="row mb-3">
    <div class="col">
      <h3>カート</h3>

    </div>
  </div>
  <div class="row">
    <div class="col-8">
      @foreach($user->carts() as $cart)
        <div class="row border-top border-muted py-3 mb-3">
          <div class="col-2 d-flex align-items-center">
            <div class="card">
                <img class="card-img-top" src="{{$cart->item()->image_url}}" alt="Card image cap">
            </div>
          </div>
          <div class="col-6">
            <p><a href="">{{$cart->item()->name}}</a></p>
            <p>残り {{$cart->item()->stock_number}}点</p>
            <button class="btn btn-primary" type="button">削除</button>
          </div>
          <div class="col-3">
            <h3>¥{{$cart->item()->price}}</h3>
          </div>
          <div class="col-1">
            <select class="form-control" name="number">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
        </div>
      @endforeach
    </div>

    <div class="offset-1 col-3 border border-muted pt-4 bg-light cart_side">
      <div class="row mb-3">
        <div class="col">
          <h5>小計（o点）：¥ooo,ooo</h5>
        </div>
      </div>
      <div class="row">
        <div class="col text-center">
          <button type="submit" class="btn btn-primary">レジに進む</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
