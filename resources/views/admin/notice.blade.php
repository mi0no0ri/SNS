@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="panel-heading">お知らせ作成 | DawnSNS 管理者ページ</h1>
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="panel panel-default">
                <form action="{{ route('admin.create_notice') }}" method="post">
                    @csrf
                    <div>
                        <label for="title">タイトル：</label><br>
                        <input type="text" id="title" name="title">
                    </div>
                    <div>
                        <label for="contents">お知らせ内容：</label><br>
                        <input type="textarea" cols="200" rows="100" id="contents" name="contents">
                    </div>
                    <button type="submit">登録する</button>
                </form>
            </div>
            <div>
                <a href="{{ route('admin.home') }}">トップに戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection
