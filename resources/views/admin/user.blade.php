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
    <form action="/admin/user/download" method="post" id = "form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <button data-action="/admin/user/download" data-method="post">ダウンロード</button>
    </form>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>電話番号</th>
                    <th>注文一覧</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->tel }}</td>
                        <td><a href="/admin/user/{{ $user->id }}/order">注文一覧</a></td>
                        <td><a href="/admin/user/{{ $user->id }}">編集</a></td>
                        <form action="/admin/user/{{ $user->id }}/delete" id="form_{{ $user->id }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <td><a href="#" data-id="{{ $user->id }}" onclick="deletePost(this);">削除</a></td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('jQuery')
function deletePost(e) {
    'use strict';

    if(confirm('本当に削除していいですか？')) {
        document.getElementById('form_' + e.dataset.id).submit();
    }
}

@endsection
