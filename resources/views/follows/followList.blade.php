@extends('layouts.login')

@section('content')
<div class="follow_container">
    <h2 class="follow_title">Follow List</h2>
        <div class="">
            <div class="follow_img">
                @foreach ($follows as $follow)
                    <ul>
                        <li><a href="{{route('user_profile',['id'=>$follow->id])}}">
                        @if($follow->images == null)
                        <img src="/storage/dawn.png" class="profile_img">
                        @else
                        <img src="/storage/userIcon/{{$follow->images}}" class="profile_img">
                        @endif
                        </a></li>
                    </ul>
                @endforeach
            </div>
            <table class="follow_list">
                @foreach ($lists as $list)
                <ul class="post_list">
                    <li><a href="{{route('user_profile',['id'=>$list->user_id])}}">
                        @if($list->images == null)
                        <img src="/storage/dawn.png" class="profile_img">
                        @else
                        <img src="/storage/userIcon/{{$list->images}}" class="profile_img">
                        @endif
                    </a></li>
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