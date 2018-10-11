@extends('layouts/admin_common')

@section('title', 'ユーザ編集')

@section('content')
<div>
    <h3>ユーザ編集</h3>
</div>
<div>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/admin/user/edit" method="post">
        {{ csrf_field() }}
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
        <label for="name" class="col-md-4 control-label">名前</label>
        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <label for="email" class="col-md-4 control-label">メールアドレス</label>
        <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" required autofocus>
        @if ($errors->has('tel'))
            <span class="help-block">
                <strong>{{ $errors->first('tel') }}</strong>
            </span>
        @endif
        <label for="tel" class="col-md-4 control-label">電話番号</label>
        <input id="tel" type="text" class="form-control" name="tel" value="{{ $user->tel }}" required autofocus>
        <button>送信</button>
        <input type="hidden" name="id" value="{{ $user->id }}">
    </form>
</div>
@endsection