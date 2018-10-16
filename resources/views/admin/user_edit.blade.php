@extends('layouts/admin_common')

@section('title', 'ユーザ編集')

@section('content')
<div>
    <h3>ユーザ編集</h3>
</div>
<div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<div>
    <form method="post" action="/admin/user/{{ $user->id }}">
        {{ csrf_field() }}
        <div>
            <label for="name">名前</label>
            <input id="name" type="text" name="name" value="{{ $user->name }}">
        </div>
        <div>
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ $user->email }}">
        </div>
        <div>
            <label for="tel">電話番号</label>
            <input id="tel" type="text" name="tel" value="{{ $user->tel }}">
        </div>
        <div>
            <label for="password">パスワード</label>
            <label for="update">更新</label><input id="update" type="checkbox" name="is_update_password" checked>
            <label for="passcheck">表示</label><input type="checkbox" id="passcheck">
            <input id="password" type="password" name="password">
        </div>
        <div>
            <label for="password_confirmation">パスワード（確認）</label>
            <input id="password_confirmation" type="password" name="password_confirmation">
        </div>
        <button type="submit">送信</button>
    </form>
</div>

@endsection
@section('jQuery')
$('#update').click(function() {
    var is_checked = $(this).prop('checked');
    if(is_checked) {
        $('#password').prop('disabled', false);
        $('#password_confirmation').prop('disabled', false);
    } else {
        $('#password').val('');
        $('#password').prop('disabled', true);
        $('#password_confirmation').val('');
        $('#password_confirmation').prop('disabled', true);
    }
});

$('#passcheck').click(function() {
    var type = $('#password').attr('type');
    if(type == 'password') {
        $('#password').attr('type', 'text');
    } else {
        $('#password').attr('type', 'password');
    }
});
@endsection