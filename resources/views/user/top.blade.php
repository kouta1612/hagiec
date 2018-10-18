@extends('layouts/common')

@section('title', '商品一覧')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-3">
      <h3 class="mb-4">カテゴリ</h3>
      <form action="/top" method="post">
        {{ csrf_field() }}
        @foreach($categories as $category)
          <p>
            <label for="{{ $loop->index }}">
              <input id="{{ $loop->index }}" type="checkbox" name="category[]" value="{{$category->id}}" class="mr-1" @if(is_array($category_ids) && in_array($category->id, $category_ids)) checked @endif>{{ $category->name }}
            </label>
          </p>
        @endforeach
        <button type="submit" class="btn btn-primary mt-3">Search</button>
      </form>
    </div>
    <div class="col-9">
      {{ $items->links("pagination::bootstrap-4") }}
      @foreach($items as $item)
        @if($loop->index % 3 == 0)
      <div class="row mb-5">
        @endif
        <div class="col-4">
          <div class="card top_card">
            <img class="card-img-top item_image contain" src="{{$item->image_url}}" alt="Card image cap">
            <div class="card-body text-center">
              <h5 class="card-title">{{ $item->name }}</h5>
              <p class="card-text">¥{{ number_format($item->price) }}</p>
              <form class="form-group" action="/cart" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <a href="/detail/{{ $item->id }}" class="btn btn-primary">詳細</a>
                <button class="btn btn-primary" type="submit">カートに追加</button>
              </form>
            </div>
          </div>
        </div>
        @if($loop->index % 3 == 2 || $loop->last)
          </div>
        @endif
      @endforeach
      {{ $items->links("pagination::bootstrap-4") }}
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
