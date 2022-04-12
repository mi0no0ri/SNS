@extends('layouts.login')

@section('content')

<div class="card-body">
     <div class="search">
        <form method="post" action="result" class="form">
            <div class="word">
                <input type="text" name="keyword" placeholder="ユーザー名" class="search_bar">
            </div>
            <input type="image" src="../images/search.png" name="submit" value="送信する" class="search_btn">
            @csrf
        </form>
    </div>
    @if($list->count())
    <table class="search_list">
        @foreach ($list as $list)
        <tr>
            <td>{{ $list->username }}</td>
        </tr>
        @endforeach
    </table>
    @else
    <p>見つかりませんでした。</p>
    @endif
</div>

@endsection