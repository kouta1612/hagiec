@extends('layouts/admin_common')

@section('title', '商品情報')

@section('content')
<div class="container">
    <div class="row">
        <div class="col my-5 text-center">
            <h3>商品一覧</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                {{ $items->links("pagination::bootstrap-4") }}
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>商品名</th>
                            <th>金額</th>
                            <th>原産国</th>
                            <th>配送必要日数</th>
                            <th>URL</th>
                            <th>在庫数</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{number_format($item->price)}}</td>
                                <td>{{$item->country}}</td>
                                <td>{{$item->delivery_date}}</td>
                                <td>{{$item->image_url}}</td>
                                <td>{{$item->stock_number}}</td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
                {{ $items->links("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>
</div>
@endsection
