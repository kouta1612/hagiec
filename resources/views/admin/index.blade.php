@extends('layouts/admin_common')

@section('title', '管理者画面')

@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center my-5">
            <h3 class="text-center">管理者画面</h3>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <p><a class="btn btn-primary" href="/admin/user">ユーザ一覧</a></p>
            <p><a class="btn btn-primary my-3" href="/admin/item">商品一覧</a></p>
            <p><a class="btn btn-primary" href="/admin/earning">売上一覧</a></p>
        </div>
    </div>
</div>
@endsection
