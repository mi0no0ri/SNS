@extends('layouts.login')

@section('content')
<div>
    <ul id="other_bar">
        <div class="other_user">
            <div>
                @if($list->images == null)
                <img src="/storage/dawn.png" class="profile_img">
                @else
                <img src="/storage/userIcon/{{$list->images}}" class="profile_img">
                @endif
            </div>
            <div class="">
                <div class="other_info">
                    <li class="other_column">Name</li>
                    <li class="other_data">{{ $list->username }}</li>
                </div>
                <div class="other_info">
                    <li class="other_column">Bio</li>
                    <li class="other_data">{{ $list->bio }}</li>
                </div>
            </div>
        </div><?php $followings = DB::table('follows')->where('follower_id',Auth::id())->get()->toArray();?>
            @if(in_array($list->id,array_column($followings,'follow_id') ))
            <form action="{{ route('unfollow', ['user' => $list->id]) }}" method="POST">
                {{ csrf_field() }}
                @method('delete')
                <button type="submit" class="btn unfollow_set_btn unfollow_button">フォローを外す</button>
            </form>
            @else
            <form action="{{ route('follow', ['user' => $list->id]) }}" method="POST">
                {{ csrf_field() }}
                <button type="submit" class="btn follow_set_btn follow_button">フォローする</button>
            </form>
            @endif
    </ul>
    <table>
        @foreach ($posts as $post)
        <ul class="post_list">
            <li><a href="">
                @if($post->images == null)
                <img src="/storage/dawn.png" class="profile_img">
                @else
                <img src="/storage/userIcon/{{$list->images}}" class="profile_img">
                @endif
            </a></li>
            <div class="post_head">
                <li class="">{{ $post->username }}</li>
                <li class="created_at">{{ $post->created_at }}</li>
            </div>
            <li class="post_content">{{ $post->post }}</li>
        </ul>
        @endforeach
    </table>
</div>

@endsection