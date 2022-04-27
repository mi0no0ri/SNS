@extends('layouts.login')

@section('content')
<div class="follow_container">
    <h2 class="follow_title">Follower List</h2>
        <div class="">
            <div class="follow_img">
                @foreach ($follower_users as $user)
                    <ul>
                        <li><a href=""><img src="/storage/dawn.png" class="profile_img" width="50" height="50"></a></li>
                    </ul>
                @endforeach
            </div>
            <table class="follow_list">
                @foreach ($lists as $list)
                <ul class="post_list">
                <li><a href="{{route('user_profile',['id'=>$list->user_id])}}"><img src="{{ $list->images }}" class="profile_img"></a></li>
                    <div class="post_head">
                        <li class="follow_username">{{ $list->username }}</li>
                        <li class="created_at">{{ $list->created_at }}</li>
                    </div>
                    <li class="post_content">{{ $list->post }}</li>
                </ul>
                @endforeach
            </table>
        </div>
    </div>


@endsection