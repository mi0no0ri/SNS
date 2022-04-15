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
            <td><img src="{{ $list->images }}" class="profile_img"></td>
            <td>{{ $list->username }}</td>
        </tr>
        <div>
            @if (auth()->user()->isFollowing($user->id))
            <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
                {{ csrf_field() }}

                <button type="submit" class="">フォロー解除</button>
            </form>
            @else
            <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                {{ csrf_field() }}

                <button type="submit" class="">フォローする</button>
            </form>
            @endif
        </div>
        @endforeach
    </table>
    @else
    <p>見つかりませんでした。</p>
    @endif
</div>

@endsection