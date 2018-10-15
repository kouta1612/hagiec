@extends('layouts/admin_common')

@section('title', 'ユーザ編集')

@section('content')
<div>
    <h3>ユーザ編集</h3>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-horizontal" method="post" action="/admin/user/{{ $user->id }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">名前</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tel" class="col-md-4 control-label">電話番号</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control" name="tel" value="{{ $user->tel }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-2 control-label">パスワード</label>
                            <label for="update">更新</label><input id="update" type="checkbox" name="is_update_password" checked>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-md-4 control-label">パスワード（確認）</label>
                            
                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    送信
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $user->id }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
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

$('button').click(function() {
    var is_checked = $(this).prop('checked');
    console.log(is_checked);
    if(!is_checked) {
        $('#password').attr('name', '');
        $('#password_confirmation').attr('name', '');
    }
})
@endsection