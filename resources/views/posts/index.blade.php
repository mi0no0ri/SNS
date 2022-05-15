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
        <input type="image" src="../images/post.png" name="submit" class="post_btn">
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
                <li class="post_content" id="post_content">{{ $list->post }}</li>
                <div class="post_list_btn">
                    @if($list->user_id == Auth::id())
                    <button href="" class="edit_btn modal_btn" data-target="modal" value="{{$list->post}}"><img src="../images/edit.png"></button>
                    <li class="delete_button">
                        <a href="/post/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
                            <img src="../images/trash_h.png" alt="削除" class="delete_btn delete_check">
                            <img src="../images/trash.png" alt="削除" class="delete_btn delete_switch_btn">
                        </a>
                    </li>
                    @endif
                </div>
            </div>
        </ul>

        <div class="modal_main js_modal" id="modal" aria-labelledby="exampleModalLabel">
            <form action="{{route('update',['id'=>$list->id])}}" method="post" id="edit" enctype="multipart/form-data">
                @csrf
                <div class="modal_content">
                    <div class="modal_inner">
                        <div class="edit_list" id="modal_body">
                            <input type="hidden" name="id" value="{{$list->id}}">
                            <input type="text" value="" class="edit_form" name="upPost" id="edit_content">
                        </div>
                    </div>
                    <div class="edit_confirm_btn">
                        <button type="submit" class="edit_btn modal_close" id="edit_btn"><img src="../images/edit.png"></button>
                    </div>
                </div>
            </form>
        </div>

        @endforeach
    </table>
</div>

@endsection