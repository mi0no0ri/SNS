@extends('layouts.login')

@section('content')
<div>
    <div id="tweet">
        {!! Form::open(['url' => 'post/create']) !!}
        <div><a href="{{route('profile')}}">
            <?php $user = Auth::user();?>
            @if($user->images == null)
            <img src="/storage/dawn.png" class="profile_img">
            @else
            <img src="/storage/userIcon/{{$user->images}}" class="profile_img">
            @endif
        </a></div>
        <div class="form_group">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form_control', 'placeholder' => '何をつぶやこうか...?']) !!}
        </div>
        <input type="image" src="../images/post.png" name="submit" value="投稿する" class="post_btn" href="post/create-form">
        {!! Form::close() !!}
    </div>
    @csrf
    <table>
        @foreach ($lists as $list)
        <ul class="post">
            <li>
                @if($list->user_id == Auth::id())
                <a href="{{route('profile')}}">
                @else
                <a href="{{route('user_profile',['id'=>$list->user_id])}}">
                @endif
                @if($list->images == null)
                <img src="/storage/dawn.png" class="profile_img">
                @else
                <img src="/storage/userIcon/{{$list->images}}" class="profile_img">
                @endif
            </a></li>
            <div class="post_list">
                <div class="post_head">
                    <li class="">{{ $list->username }}</li>
                    <li class="created_at">{{ $list->created_at }}</li>
                </div>
                <li class="post_content">{{ $list->post }}</li>
                <div class="post_list_btn">
                    @if($list->user_id == Auth::id())
                    <li><a href="/post/{{$list->id}}/update-form" class="edit_btn"><img src="../images/edit.png" alt="編集"></a></li>
                    <li><a href="/post/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"><img src="../images/trash_h.png" alt="削除" class="delete_btn"></a></li>
                    @endif
                </div>
            </div>
        </ul>
        @endforeach
    </table>
</div>

@endsection