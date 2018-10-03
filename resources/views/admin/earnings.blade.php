@extends('layouts/admin_common')

@section('title', '月別売上')

@section('content')
<div>
    <form action="/admin/earnings" method="get">
        <p><input type="month" name="month" value="2018-10">の売上合計金額 円</p>
        <input type="submit" value="送信">
    </form>
</div>
<div>
    <table>
        <thead>
            <tr>
                <th>注文番号</th>
                <th>リンク</th>
                {{--<th>注文金額</th>--}}
            </tr>
        </thead>
        <tbody>
            @foreach ($orders_in_month as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td><a href="/admin/earning/{{$order->id}}">注文明細</a></td>
                    {{--<td>{{$order->total}}</td>--}}
                </tr> 
            @endforeach
        </tbody>
    </table>
</div>
@endsection