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
    <table>
        @foreach ($list as $list)
        <ul class="search_page">
            <ul class="search_list">
                <li class="search_img"><img src="{{ $list->images }}" class="profile_img"></li>
                <li class="search_name">{{ $list->username }}</li>
            </ul>
            <li class="follow_btn">
                @if(auth()->user()->isFollow($user->id))
                <form action="{{ route('unfollow', ['user' => $list->id]) }}" method="POST">
                    {{ csrf_field() }}
                    @method('delete')
                    <button type="submit" class="btn unfollow_set_btn">フォロー解除</button>
                </form>
                @else
                <form action="{{ route('follow', ['user' => $list->id]) }}" method="POST">
                    {{ csrf_field() }}

                    <button type="submit" class="btn follow_set_btn">フォローする</button>
                </form>
                @endif
            </li>
        </ul>
        @endforeach
    </table>
    @else
    <p>見つかりませんでした。</p>
    @endif
</div>

@endsection