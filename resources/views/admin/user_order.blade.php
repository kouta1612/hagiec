@extends('layouts/admin_common')

@section('title', 'ユーザの注文一覧')

@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center my-5">
            <h3>注文一覧</h3>
            <h3>（user_id：{{ $user->id }}　name：{{ $user->name }}）</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>注文番号</th>
                        <th>注文日時</th>
                        <th>配送希望日</th>
                        <th>配送方法</th>
                        <th>注文金額</th>
                        <th>リンク</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user_orders as $user_order)
                        <tr>
                            <td>{{ $user_order->id }}</td>
                            <td>{{ $user_order->order_time }}</td>
                            <td>{{ $user_order->delivery_day }}</td>
                            <td>{{ $user_order->delivery_method }}</td>
                            <td>¥{{ number_format($user_order->order_price) }}</td>
                            <td><a href="/admin/user/{{ $user->id }}/order/{{ $user_order->id }}">注文詳細</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div>
    
</div>
@endsection