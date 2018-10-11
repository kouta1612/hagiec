@extends('layouts/admin_common')

@section('title', '商品情報')

@section('content')
<div>
    <h3>ユーザ情報</h3>
    {{--
    <div>
        <table>
            <thead>
                <tr>
                    <th>顧客ID</th>
                    <th>顧客名</th>
                    <th>メールアドレス</th>
                    <th>パスワード</th>
                    <th>電話番号</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->password}}</td>
                        <td>{{$user->tel}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    --}}
    <form action="/admin/users/upload" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <p><input type="file" name="csv_file"></p>
        <button class="submit" data-action="/admin/users/upload">アップロード</button>
        <button class="submit" data-action="/admin/users/download">ダウンロード</button>
    </form>

</div>
@endsection

@section('jQuery')
$('.submit').click(function(){
    $(this).parent('form').attr('action', $(this).data('action'));
    $(this).parent('form').submit();
})
@endsection
