@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <h1 class="panel-heading">DawnSNS 管理者ページ</h1>
                <div>
                    <a href="{{ route('admin.notice') }}">お知らせを作成</a>
                    <a href="{{ route('admin.notice_list') }}">お知らせ一覧</a>
                </div>
                <div>
                    <a href="{{ route('admin.question') }}">よくある質問作成</a>
                    <a href="{{ route('admin.question_list') }}">よくある質問一覧</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
