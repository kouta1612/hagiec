@extends('layouts/admin_common')

@section('title', 'ユーザの注文一覧')

@section('content')
<div>
    <h3>注文一覧（ID：{{ $user->id }}　名前：{{ $user->name }}）</h3>
</div>
<div>
    <table>
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
                    <td>{{ $user_order->order_price }}</td>
                    <td><a href="/admin/user/{{ $user->id }}/order/{{ $user_order->id }}">注文詳細</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection