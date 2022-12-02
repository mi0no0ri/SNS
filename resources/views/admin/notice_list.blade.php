@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="panel-heading">お知らせ一覧 | DawnSNS 管理者ページ</h1>
            <div class="panel panel-default">
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
                        <td>
                            <form action="{{ route('admin.notice_editForm', ['id' => $notice->id]) }}">
                                @csrf
                                <button type="submit">編集</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.delete_notice',['id' => $notice->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="alert('このお知らせを削除しますか');">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div>
                <a href="{{ route('admin.home') }}">トップに戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection
