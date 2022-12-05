@extends('layouts.login')

@section('content')

<div>
  <h1 class="notice_title">お知らせ</h1>
    <table class="notice_list">
        <tr>
            <th class="w_150">タイトル</th>
            <th class="w_400">内容</th>
            <th class="w_150">作成日時</th>
            <th class="w_150">更新日時</th>
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
