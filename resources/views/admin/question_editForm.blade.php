@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="panel-heading">よくある質問編集 | DawnSNS 管理者ページ</h1>
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="panel panel-default">
                <form action="{{ route('admin.edit_question', ['id' => $question->id]) }}" method="post">
                    @csrf
                    <div>
                        <label for="title">タイトル：</label><br>
                        <input type="text" id="title" name="title" value="{{ $question->title }}">
                    </div>
                    <div>
                        <label for="contents">お知らせ内容：</label><br>
                        <input type="textarea" cols="200" rows="100" id="contents" name="contents" value="{{ $question->contents }}">
                    </div>
                    <button type="submit">登録する</button>
                </form>
            </div>
            <div>
                <a href="{{ route('admin.question_list') }}">一覧に戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection
