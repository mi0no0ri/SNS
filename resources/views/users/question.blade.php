@extends('layouts.login')

@section('content')

<div>
  <h1>よくある質問</h1>
    <table>
        <tr>
            <th>タイトル</th>
            <th>内容</th>
            <th>作成日時</th>
            <th>更新日時</th>
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
