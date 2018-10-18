@extends('layouts/admin_common')

@section('title', '月別売上')

@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center my-5">
            <h3>注文詳細</h3>
        </div>
    </div>
    <div class="row border py-3">
        <div class="col-md-4 text-center">
            <p>お届け先住所</p>
            <p>{{ $user_data->name }}</p>
            <p>{{ $user_data->postal_code }}</p>
            <p>{{ $user_data->state }} {{ $user_data->city }}{{ $user_data->street }}{{ $user_data->building }}</p>
            <p>{{ $user_data->tel }}</p>
        </div>
        <div class="col-md-4 text-center">
            <p>支払い方法</p>
            <p>{{ $user_data->state == 0 ? "代金引換" : "クレジット" }}</p>
        </div>
        <div class="col-md-4 text-center">
            <p>注文内容</p>
            <p><strong>注文合計：{{ $total_price }}</strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col mt-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>注文詳細ID</th>
                        <th>商品名</th>
                        <th>単価</th>
                        <th>個数</th>
                        <th>合計金額</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_details as $order_detail)
                        <tr>
                            <td>{{ $order_detail->id }}</td>
                            <td>{{ $order_detail->name }}</td>
                            <td>¥{{ number_format($order_detail->price) }}</td>
                            <td>{{ $order_detail->number }}</td>
                            <td>¥{{ number_format($order_detail->total_price) }}</td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>
<div>
    <div>
        
    </div>
</div>
@endsection
