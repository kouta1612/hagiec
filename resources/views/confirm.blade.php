@extends('layouts/common')

@section('title', '決済確認画面')

@section('content')
<div class="container">
  <div class="row">
    <button type="button" class="btn btn-primary mb-5 mx-auto">注文確定</button>
  </div>
  <div class="row border border-muted mb-3 mx-auto p-3">
    {{--お届け先住所--}}
    <div class="col-4">
      {{--確認画面でのお届け先住所--}}
      <div class="address-header">
        <strong>お届け先住所</strong>
        <a href="" data-toggle="modal" data-target=".bd-example-modal-lg">変更</a>
        {{--モーダル表示部分--}}
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
                        <ul>
                          <li class="mb-1"><strong>{{$address->name}}</strong></li>
                          <li>〒{{$address->postal_code}}</li>
                          <li>{{$address->state}} {{$address->city}}{{$address->street}}</li>
                          <li>{{$address->building}}</li>
                          <li>電話番号: {{$address->tel}}</li>
                        </ul>
                        <button class="btn btn-primary mt-3" type="button" name="button">この住所を使う</button>
                      </div>
                    </div>
                  @if($loop->index % 3 == 2)
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
        {{--モーダル表示部分終了--}}
      </div>
      <div class="address-body">
        <ul>
          <li>萩原孔太</li>
          <li>111-1111</li>
          <li>東京都 足立区足立3-23-14</li>
          <li>建物プレイス301号室</li>
          <li>電話番号: 09042097977</li>
        </ul>
      </div>
    </div>

    {{--配送希望日--}}
    <div class="col-4">
      <div class="deliver-header">
        <strong>配送希望日</strong><br>
        {{--<a href="" id="deliver-modal">変更</a>--}}
      </div>
      <div class="deliver-body">
        <input type="text" id="datepicker">
      </div>
    </div>

    {{--支払い方法--}}
    <div class="col-4">
      <div class="payment-header">
        <strong>支払い方法</strong>
        <a href="#" id="payment-modal">変更</a>
      </div>
      <div class="payment-body">
        クレジットカード
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
            <td>{{$totalQuantity}}点</td>
          </tr>
          <tr>
            <th>小計</th>
            <td>¥{{$totalPrice}}</td>
          </tr>
        </table>
        {{--
        <ul class="list-group">
          <li class="list-group-item">商品数 {{$totalQuantity}}点</li>
          <li class="list-group-item">小計 ¥{{$totalPrice}}</li>
        </ul>
        --}}
      </div>
    </div>
  </div>
</div>
@endsection

@section('jQuery')
<script>
$(function() {
  // テキストボックスへ Datepicker を仕掛ける
  $( "#datepicker" ).datepicker({
    buttonImage: "https://webllica.com/wp-content/themes/webllica/img/calendar-icon2.png",
    buttonImageOnly: true,
    showOn: "both"
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
   dateFormat: 'yy/mm/dd',
   firstDay: 0,
   isRTL: false,
   showMonthAfterYear: true,
   yearSuffix: '年'};
 $.datepicker.setDefaults($.datepicker.regional['ja']);
});
</script>
@endsection
