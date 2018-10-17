@extends('layouts/admin_common')

@section('title', 'ユーザ編集')

@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center my-5">
            <h3>ユーザ編集</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
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
    </div>
    <div class="row">
        <div class="col">
            <form method="post" action="/admin/user/{{ $user->id }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">名前</label>
                    <input class="form-control" id="name" type="text" name="name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input class="form-control" id="email" type="email" name="email" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="tel">電話番号</label>
                    <input class="form-control" id="tel" type="text" name="tel" value="{{ $user->tel }}">
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <label for="update">更新</label><input id="update" type="checkbox" name="is_update_password" checked>
                    <input class="form-control" id="password" type="password" name="password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">パスワード（確認）</label>
                    <input class="form-control" id="password_confirmation" type="password" name="password_confirmation">
                </div>
                <button class="btn btn-primary" type="submit">送信</button>
            </form>
        </div>
    </div>
</div>
<div>
    
</div>
<div>
    
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