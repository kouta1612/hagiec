@extends('layouts/common')

@section('title', '決済確認画面')

@section('content')
<div class="container">
  <div class="row">
    <button type="button" class="btn btn-primary mb-5 mx-auto">注文確定</button>
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
          {{--
          <tr>
            <td>
              <input type="radio" name="" value="">
            </td>
            <td>
              <table class="table table-bordered">
                <tr>
                  <th>名前</th>
                  <td>ベンジョンソン</td>
                </tr>
                <tr>
                  <th>住所</th>
                  <td>東京都渋谷区笹塚1-11-1</td>
                </tr>
              </table>
            </td>
          </tr>
          --}}
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
  <div class="row">
    <div class="col">
      <div class="card-header">
        お届け先住所
        <button class="btn btn-primary ml-3" type="button" name="button">追加</button>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <tr>
            <td rowspan="2"><input type="radio" name="" value=""></td>
            <th>名前</th>
            <td>ベンジョンソン</td>
          </tr>
          <tr>
            <th>住所</th>
            <td>東京都渋谷区笹塚1-11-1</td>
          </tr>
          {{--
          <tr>
            <td>
              <input type="radio" name="" value="">
            </td>
            <td>
              <table class="table table-bordered">
                <tr>
                  <th>名前</th>
                  <td>ベンジョンソン</td>
                </tr>
                <tr>
                  <th>住所</th>
                  <td>東京都渋谷区笹塚1-11-1</td>
                </tr>
              </table>
            </td>
          </tr>
          --}}
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
