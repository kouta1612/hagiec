@extends('layouts/admin_common')

@section('title', '月別売上')

@section('content')
<div>
    <h3>注文詳細</h3>
</div>
<div>
    <table>
        <thead>
            <tr>
                <th>注文明細ID</th>
                <th>商品名</th>
                <th>単価</th>
                <th>購入数</th>
                <th>合計金額</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order_details as $order_detail)
                <tr>
                    <td>{{ $order_detail->id }}</td>
                    <td>{{ $order_detail->name }}</td>
                    <td>{{ $order_detail->price }}</td>
                    <td>{{ $order_detail->number }}</td>
                    <td>{{ $order_detail->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
