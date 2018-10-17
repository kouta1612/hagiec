@extends('layouts/admin_common')

@section('title', '商品情報')

@section('content')
<div class="container">
    <div class="row">
        <div class="col my-5 text-center">
            <h3>商品情報</h3>
        </div>
    </div>
    <div class="row">
        <div class="col my-5 text-center">
            <form action="/admin/items/upload" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="input-group mb-5">
                    <label class="input-group-btn">
                        <span class="btn btn-primary">
                            Choose File<input class="form-control-file" id="csv_file_input" type="file" name="csv_file" style="display:none">
                        </span>
                    </label>
                    <input type="text" class="form-control" readonly="">
                </div>
                <button class="submit btn btn-primary mr-3" data-action="/admin/item/upload">アップロード</button>
                <button class="submit btn btn-primary" data-action="/admin/item/download">ダウンロード</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('jQuery')
$('.submit').click(function(){
    $(this).parent('form').attr('action', $(this).data('action'));
    $(this).parent('form').submit();
})

$(document).on('change', ':file', function() {
    var input = $(this),
    numFiles = input.get(0).files ? input.get(0).files.length : 1,
    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.parent().parent().next(':text').val(label);
});
@endsection
