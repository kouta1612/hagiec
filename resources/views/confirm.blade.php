@extends('layouts/common')

@section('title', '決済確認画面')

@section('content')
<div class="container">
  <div class="row">
    <button type="button" class="btn btn-primary mb-5 mx-auto">注文確定</button>
  </div>
  <div class="row border border-muted mb-3 mx-auto p-3">
    <div class="col-4">
      <div class="address-header">
        <strong>お届け先住所</strong>
        <a data-toggle="modal" data-target=".bd-example-modal-lg">変更</a>
        {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"></button>--}}
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
                  <div class="row mb-3">
                    <div class="col-4">
                      <div class="address-body">
                        <ul>
                          <li><strong>萩原孔太</strong></li>
                          <li>111-1111</li>
                          <li>東京都 足立区足立3-23-14</li>
                          <li>建物プレイス301号室</li>
                          <li>電話番号: 09042097977</li>
                        </ul>
                        <button class="btn btn-primary" type="button" name="button">この住所を使う</button>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="address-body">
                        <ul>
                          <li><strong>萩原孔太</strong></li>
                          <li>111-1111</li>
                          <li>東京都 足立区足立3-23-14</li>
                          <li>建物プレイス301号室</li>
                          <li>電話番号: 09042097977</li>
                        </ul>
                        <button class="btn btn-primary" type="button" name="button">この住所を使う</button>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="address-body">
                        <ul>
                          <li><strong>萩原孔太</strong></li>
                          <li>111-1111</li>
                          <li>東京都 足立区足立3-23-14</li>
                          <li>建物プレイス301号室</li>
                          <li>電話番号: 09042097977</li>
                        </ul>
                        <button class="btn btn-primary" type="button" name="button">この住所を使う</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="address-body">
        <ul>
          <li>萩原</li>
          <li>111-1111</li>
          <li>東京都 足立区足立3-23-14</li>
          <li>建物プレイス301号室</li>
          <li>電話番号: 09042097977</li>
        </ul>
      </div>
    </div>
    <div class="col-4">
      <div class="deliver-header">
        <strong>配送希望日</strong>
        <a id="deliver-modal">変更</a>
      </div>
      <div class="deliver-body">
        2018/6/7
      </div>
    </div>
    <div class="col-4">
      <div class="payment-header">
        <strong>支払い方法</strong>
        <a id="payment-modal">変更</a>
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
