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
        @if($keyword == null)
        @else
        <p class="keyword">検索ワード：{{ $keyword }}</p>
        @endif
    </div>
    @if(isset($lists))
    <table class>
        @foreach ($lists as $list)
        <ul class="search_page">
            <ul class="search_list">
                <li class="search_img"><a href="{{route('user_profile',['id'=>$list->id])}}">
                    {{ csrf_field() }}
                    @if($list->images == null)
                    <img src="/storage/dawn.png" class="profile_img">
                    @else
                    <img src="/storage/userIcon/{{$list->images}}" class="profile_img">
                    @endif
                </a></li>
                <li class="search_name">{{ $list->username }}</li>
            </ul>
            <li class="follow_btn">
                @if(in_array($list->id,array_column($followings,'follow_id') ))
                <form action="{{ route('unfollow', ['user' => $list->id]) }}" method="POST">
                    {{ csrf_field() }}
                    @method('DELETE')
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
    @endif
</div>

@endsection