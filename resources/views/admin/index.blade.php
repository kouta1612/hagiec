@extends('layouts/admin_common')

@section('title', '管理者画面')

@section('content')
<div>
    <h3>管理者画面</h3>
</div>
<div>
    <p><a href="/admin/user">ユーザ一覧</a></p>
    <p><a href="/admin/item">商品一覧</a></p>
    <p><a href="/admin/earning">売上一覧</a></p>
</div>
@endsection