@extends('layouts/common')

@section('title', 'カート画面')

@section('content')
<div class="container">
  <div class="row mb-3">
    <div class="col">
      <h3>カート</h3>
    </div>
  </div>
  <div class="row" id="cartItems">
    <div class="col-8">
      @if(count($carts) == 0)
      <h3>現在商品がありません</h3>
      @else
      @foreach($cart_in_items as $cart_in_item)
      @if($cart_in_item->pivot->status == 1)
      <div class="row border-top border-muted py-3 mb-3 cartItem" id="{{ $cart_in_item->id }}">
        <div class="col-2 d-flex align-items-center">
          <div class="card">
              <img class="card-img-top" src="{{ $cart_in_item->image_url }}" alt="Card image cap">
          </div>
        </div>
        <div class="col-5">
          <p><a href="/detail">{{ $cart_in_item->name }}</a></p>
          <p>残り {{ $cart_in_item->stock_number }}点</p>
          <form class="form-group" action="/destroy/{{ $cart_in_item->id }}" id="form_{{ $cart_in_item->id }}" method="post">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <button data-id="{{$cart_in_item->id}}" class="btn btn-danger" type="submit" onclick="delete(this);">削除</button>
          </form>
        </div>
        <div class="col-3">
          <h3>¥<span class="itemPrice">{{ number_format($cart_in_item->price) }}</span></h3>
        </div>
        <div class="col-2">
          <select class="form-control" name="number">
            @for($i = 0; $i < $cart_in_item->stock_number; $i++)
              @if($i + 1 == $cart_in_item->pivot->quantity)
                <option value="{{ $i + 1 }}" selected="selected">{{ $i + 1 }}</option>
              @else
                <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
              @endif
            @endfor
          </select>
        </div>
      </div>
      @endif
      @endforeach
      @endif
    </div>

    @if(count($carts) > 0)
    <div class="offset-1 col-3 border border-muted pt-4 bg-light cart_side">
      <div class="row mb-3">
        <div class="col">
          <h5>小計（<span class="totalQuantity">0</span>点）：¥<span class="totalPrice">0</span></h5>
        </div>
      </div>
      <div class="row">
        <div class="col text-center">
          <form class="form-group" action="/confirm" method="get">
            {{ csrf_field() }}
            <input type="hidden" name="totalQuantity">
            <input type="hidden" name="totalPrice">
            <button type="submit" class="btn btn-primary">レジに進む</button>
          </form>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>
@endsection

@section('jQuery')
<script>
  // ページ起動時の値
  $(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $totalQuantity = 0;
    $totalPrice = 0;
    $('#cartItems').find('.cartItem').each(function() {
      $quantity = parseInt($(this).find('select').val());
      $price = parseInt($(this).find('.itemPrice').text().split(',').join(''));
      $totalQuantity += $quantity;
      $totalPrice += $quantity * $price;
    });
    $('.totalQuantity').text($totalQuantity);
    $('.totalPrice').text(new Intl.NumberFormat('ja-JP').format($totalPrice));
    $('input[name="totalQuantity"]').val($totalQuantity);
    $('input[name="totalPrice"]').val($totalPrice);
  });
  // カート内商品数変更時の値
  $('#cartItems select').change(function() {
    $totalQuantity = 0;
    $totalPrice = 0;
    $('#cartItems').find('.cartItem').each(function() {
      $quantity = parseInt($(this).find('select').val());
      $price = parseInt($(this).find('.itemPrice').text());
      $totalQuantity += $quantity;
      $totalPrice += $quantity * $price;
      $item_id = $(this).attr('id');
      $user_id = {{Auth::id()}};
      // ajaxでカートテーブルの数量を変更
      $.ajax({
        type:'POST',
        url:'/ajax_cart',
        data:{
          "user_id":$user_id,
          "item_id":$item_id,
          "quantity":$quantity,
        },
        success:function(data) {
          $('.totalQuantity').text($totalQuantity);
          $('.totalPrice').text($totalPrice);
          console.log(data);
        },
        error:function(XMLHttpRequest, textStatus, errorThrown) {
          console.log("XMLHttpRequest : " + XMLHttpRequest.status);
          console.log("textStatus     : " + textStatus);
          console.log("errorThrown    : " + errorThrown.message);
        },
      });
    });
  });
</script>
@endsection
