@extends('layouts/admin_common')

@section('title', 'ユーザ情報')

@section('content')
<div>
    <h3>ユーザ情報</h3>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/admin/users/upload" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <button class="submit" data-action="/admin/users/download">ダウンロード</button>
    </form>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>電話番号</th>
                    <th>編集</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->tel}}</td>
                        <td><a href="/admin/user/{{$user->id}}">編集</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('jQuery')
@endsection
