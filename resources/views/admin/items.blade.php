@extends('layouts/admin_common')

@section('title', '商品情報')

@section('content')
<div>
    <h3>商品情報</h3>
    {{--
    <div>
        <table>
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
                        <td>{{$item->price}}</td>
                        <td>{{$item->country}}</td>
                        <td>{{$item->delivery_date}}</td>
                        <td>{{$item->image_url}}</td>
                        <td>{{$item->stock_number}}</td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
    --}}
    <form action="/admin/items/upload" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <p><input type="file" name="csv_file"></p>
        <button class="submit" data-action="/admin/items/upload">アップロード</button>
        <button class="submit" data-action="/admin/items/download">ダウンロード</button>
    </form>

</div>
@endsection

@section('jQuery')
$('.submit').click(function(){
    $(this).parent('form').attr('action', $(this).data('action'));
    $(this).parent('form').submit();
})
@endsection
