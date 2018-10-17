@extends('layouts/admin_common')

@section('title', '月別売上')

@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center my-5">
            <h3>月別売上</h3>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <form action="/admin/earning" method="get">
                <p><input class="mb-5" type="month" name="month" value="{{$selected_year}}-{{$selected_month}}">の売上合計金額 {{$total_price}}円</p>
                <button class="submit btn btn-primary mr-3" data-action="/admin/earning">送信</button>
                <button class="submit btn btn-primary" data-action="/admin/earning/csv">CSV出力</button>
            </form>        
        </div>
    </div>
    <div class="row">
        <div class="col mt-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>注文番号</th>
                        <th>リンク</th>
                        <th>注文金額</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders_in_month as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td><a href="/admin/earning/{{$order->id}}">注文明細</a></td>
                            <td>{{$order->price}}</td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('jQuery')
$('.submit').click(function(){
    $(this).parent('form').attr('action', $(this).data('action'));
    $(this).parent('form').submit();
})
@endsection