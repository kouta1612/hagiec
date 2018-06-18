@extends('layouts/common')

@section('title', '決済確認画面')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12 text-center">
      {{--住所モーダル表示部分--}}
      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">お届け先を選択してください</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                @foreach($user->addresses() as $address)
                @if($loop->index % 3 == 0)
                <div class="row mb-3">
                @endif
                  <div class="col-4">
                    <div class="address-body">
                      <form class="form-group" method="post" action="/confirm">
                        {{ csrf_field() }}
                        <ul>
                          <li class="mb-1"><strong>{{$address->name}}</strong></li>
                          <li>〒{{$address->postal_code}}</li>
                          <li>{{$address->state}} {{$address->city}}{{$address->street}}</li>
                          <li>{{$address->building}}</li>
                          <li>電話番号: {{$address->tel}}</li>
                        </ul>
                        <input type="hidden" name="id" value="{{$address->id}}">
                        <button class="btn btn-primary mt-3 select_address" type="submit" name="button">この住所を使う</button>
                      </form>
                    </div>
                  </div>
                @if($loop->index % 3 == 2 || $loop->last)
                </div>
                @endif
                @endforeach
                <div class="row mb-3">
                  <a class="btn btn-secondary mt-4 mx-auto" href="/address">住所を追加</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--住所モーダル表示部分終了--}}
      {{--支払いモーダル表示部分--}}
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">支払い方法を選択してください</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="payment_form" class="form-group" action="/payment/0" method="post">
                {{ csrf_field() }}
                <div class="text-center py-5">
                  {{--
                    <button class="btn btn-primary mr-5 submit" id="money">代金引換</button>
                    <button class="btn btn-primary submit" id="credit">クレジット</button>
                   --}}
                   <button class="btn btn-primary mr-5 submit" data-action="/payment/0">代金引換</button>
                   <button class="btn btn-primary submit" data-action="/payment/1">クレジット</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      {{--支払いモーダル表示部分終了--}}
      <form class="form-group" action="/done_payment" method="post">
        {{ csrf_field() }}
        <button id="done_payment" type="submit" class="btn btn-primary mb-5 mx-auto">注文確定</button>
    </div>
  </div>
  <div class="row border border-muted mb-3 mx-auto p-3">
    {{--確認画面でのお届け先住所--}}
    <div class="col-4">
      {{--確認画面でのお届け先住所--}}
      <div class="address-header">
        <strong>お届け先住所</strong>
        <a href="" data-toggle="modal" data-target=".bd-example-modal-lg">変更</a>
      </div>
      {{--確認画面でのお届け先住所--}}
      <div class="address-body">
        <ul>
          <li>{{$user->selected_address()->name}}</li>
          <li>{{$user->selected_address()->postal_code}}</li>
          <li>{{$user->selected_address()->state}} {{$user->selected_address()->city}}{{$user->selected_address()->street}}</li>
          <li>{{$user->selected_address()->building}}</li>
          <li>電話番号: {{$user->selected_address()->tel}}</li>
          <li><input type="hidden" name="delivery_id" value="{{$user->selected_address()->id}}"></li>
        </ul>
      </div>
    </div>

    {{--配送希望日--}}
    <div class="col-4">
      <div class="deliver-header">
        <strong>配送希望日</strong><br>
      </div>
        <div class="deliver-body form-group{{ $errors->has('delivery_date') ? 'has-error' : '' }}">
          <input type="text" name="delivery_date" id="datepicker" value="{{old('delivery_date')}}" required autofocus>
          @if($errors->has('delivery_date'))
            <span class="form-text text-danger">
              <strong>{{ $errors->first('delivery_date') }}</strong>
            </span>
          @endif
        </div>
    </div>

    {{--支払い方法--}}
    <div class="col-4">
      <div class="payment-header">
        <strong>支払い方法</strong>
        <a href="" data-toggle="modal" data-target="#exampleModal">変更</a>
      </div>
      <div class="payment-body">
        @if($user->payment_status()->payment_status == 0)
        現金引換
        <input type="hidden" name="payment" value="現金引換">
        @elseif($user->payment_status()->payment_status == 1)
        クレジットカード
        <input type="hidden" name="payment" value="クレジットカード">
        @endif
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card-header">
        注文内容
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <tr>
            <th>商品数</th>
            <td>{{$user->totalQuantity()}}点</td>
          </tr>
          <tr>
            <th>小計</th>
            <td>¥{{$user->totalPrice()}}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
</form>
@endsection

@section('jQuery')
<script>
$(function() {

  // クレジットor現金引換ボタン押下時の処理振分け
  $('.submit').click(function() {
    $(this).parents('form').attr('action', $(this).data('action'));
    $(this).parents('form').submit();
  });

  // テキストボックスへ Datepicker を仕掛ける
  $("#datepicker").datepicker({
    buttonImage: "https://webllica.com/wp-content/themes/webllica/img/calendar-icon2.png",
    buttonImageOnly: true,
    showOn: "both",
    minDate: '+2d',
  });
  // 日本語化
  $.datepicker.regional['ja'] = {
   closeText: '閉じる',
   prevText: '<前',
   nextText: '次>',
   currentText: '今日',
   monthNames: ['1月','2月','3月','4月','5月','6月',
   '7月','8月','9月','10月','11月','12月'],
   monthNamesShort: ['1月','2月','3月','4月','5月','6月',
   '7月','8月','9月','10月','11月','12月'],
   dayNames: ['日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'],
   dayNamesShort: ['日','月','火','水','木','金','土'],
   dayNamesMin: ['日','月','火','水','木','金','土'],
   weekHeader: '週',
   dateFormat: 'yy-mm-dd',
   firstDay: 0,
   isRTL: false,
   showMonthAfterYear: true,
   yearSuffix: '年'};
  $.datepicker.setDefaults($.datepicker.regional['ja']);
});
</script>
@endsection
