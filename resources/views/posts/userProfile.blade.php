@extends('layouts.login')

@section('content')
<div>
    <ul>
        <div>
            <img src="{{ $list->images }}" class="profile_img">
        </div>
        <div>
            <li>Name</li>
            <li>{{ $list->username }}</li>
        </div>
        <div>
            <li>Bio</li>
            <li>{{ $list->bio }}</li>
        </div>
        <button src="" value="フォローする"></button>
    </ul>
    <table>
        @foreach ($lists as $list)
        <ul class="post_list">
            <li><a href=""><img src="{{ $list->images }}" class="profile_img"></a></li>
            <div class="post_head">
                <li class="">{{ $list->username }}</li>
                <li class="created_at">{{ $list->created_at }}</li>
            </div>
            <li class="post_content">{{ $list->post }}</li>
        </ul>
        @endforeach
    </table>
</div>

@endsection