@extends('layouts/admin_common')

@section('title', '月別売上詳細')

@section('content')
<div class="container">
    <div class="row">
        <div class="col my-5 text-center">
            <h3>月別売上詳細</h3>
        </div>
    </div>
    <div class="row">
        <div class="col ">
            <table class="table table-striped">
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
                    @foreach ($earning_detail_datas as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ number_format($data->price) }}</td>
                        <td>{{ $data->number }}</td>
                        <td>{{ number_format($data->total_price) }}</td>
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
