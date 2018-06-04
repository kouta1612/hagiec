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
          <div class="col-5">
            <p><a href="/detail/{{$cart->item()->id}}">{{$cart->item()->name}}</a></p>
            <p>残り {{$cart->item()->stock_number}}点</p>
            <form class="form-group" action="/destroy/{{$cart->item()->id}}" id="form_{{$cart->item()->id}}" method="post">
              {{ csrf_field() }}
              {{ method_field('delete') }}
              <button data-id="{{$cart->item()->id}}" class="btn btn-danger" type="submit" onclick="delete(this);">削除</button>
            </form>
          </div>
          <div class="col-3">
            <h3>¥{{$cart->item()->price}}</h3>
          </div>
          <div class="col-2">
            <select class="form-control" name="number">
              @for($i = 0; $i < $cart->item()->stock_number; $i++)
                @if($i + 1 == $cart->quantity)
                  <option value="{{$i + 1}}" selected="selected">{{$i + 1}}</option>
                @else
                  <option value="{{$i + 1}}">{{$i + 1}}</option>
                @endif
              @endfor
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

@section('ajax')
<script>

</script>
@endsection
