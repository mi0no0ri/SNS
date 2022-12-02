@extends('layouts.login')

@section('content')

<div>
  <h1>お知らせ</h1>
    <table>
        <tr>
            <th>タイトル</th>
            <th>内容</th>
            <th>作成日時</th>
            <th>更新日時</th>
        </tr>
        @foreach($noticies as $notice)
        <tr>
            <td>{{ $notice->title }}</td>
            <td>{{ $notice->contents }}</td>
            <td>{{ $notice->created_at }}</td>
            <td>{{ $notice->updated_at }}</td>
        </tr>
        @endforeach
    </table>
</div>

@endsection
