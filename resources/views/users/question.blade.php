@extends('layouts.login')

@section('content')

<div>
  <h1 class="question_title">よくある質問</h1>
    <table class="question_list">
        <tr>
            <th class="w_150">タイトル</th>
            <th class="w_400">内容</th>
            <th class="w_150">作成日時</th>
            <th class="w_150">更新日時</th>
        </tr>
        @foreach($questions as $question)
        <tr>
            <td>{{ $question->title }}</td>
            <td>{{ $question->contents }}</td>
            <td>{{ $question->created_at }}</td>
            <td>{{ $question->updated_at }}</td>
        </tr>
        @endforeach
    </table>
</div>

@endsection
