@extends('layouts.login')

@section('content')
<div>
    <div id="tweet">
        {!! Form::open(['url' => 'post/create', 'class' => 'index_form']) !!}
        <div>
            <a href="{{route('profile')}}">
                <?php $user = Auth::user();?>
                @if($user->images == null)
                <img src="/storage/dawn.png" class="profile_img">
                @else
                <img src="/storage/userIcon/{{$user->images}}" class="profile_img">
                @endif
            </a>
        </div>
        <div class="form_group">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form_control', 'placeholder' => '何をつぶやこうか...?']) !!}
        </div>
        <input type="image" src="../images/post.png" name="submit" class="post_btn">
        {!! Form::close() !!}
    </div>
    <table>
        @foreach ($lists as $list)
        @continue($list->user_id == $list->blocked_userId)
        <ul class="post">
            <div id="profile_bar">
                <li id="user_image">
                    <a href="{{route('user_profile',['id'=>$list->user_id])}}">
                    @if($list->images == null)
                    <img src="/storage/dawn.png" class="profile_img">
                    @else
                    <img src="/storage/userIcon/{{$list->images}}" class="profile_img">
                    @endif
                    </a>
                </li>
                <div id="favorite_icon">
                    @if(Auth::check())
                        @if(Auth::user()->favorites()->where('post_id', $list->id)->exists())
                        <form action="{{ route('unfavorite', $list->id) }}" method="post">
                            <input type="hidden" name="post_id">
                            @csrf
                            @method('delete')
                            <button type="submit" class="favo_btn">
                                <i class="fas fa-heart"></i>
                            </button>
                        </form>
                        @else
                        <form action="{{ route('favorite', $list->id) }}" method="post">
                            <input type="hidden" name="post_id">
                            @csrf
                            <button type="submit" class="favo_btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </form>
                        @endif
                    @endif
                </div>
            </div>
            <div class="post_list">
                <div class="post_head">
                    <li class="">{{ $list->username }}</li>
                    <li class="created_at">{{ $list->created_at }}</li>
                </div>
                <li class="" id="post_content">{{ $list->post }}</li>
                <div class="post_list_btn">
                    @if($list->user_id == Auth::id())
                    <button href="" class="edit_btn modal_btn" data-target="modal{{$list->id}}" value="{{$list->post}}">
                        <img src="../images/edit.png">
                    </button>
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

        <div class="modal_main js_modal modal" id="modal{{$list->id}}" aria-labelledby="exampleModalLabel">
            <form action="{{route('update')}}" method="post" id="edit" enctype="multipart/form-data">
                @csrf
                <div class="modal_content">
                    <div class="modal_inner">
                        <div class="edit_list" id="modal_body">
                            <input type="hidden" value="{{$list->id}}" name="id">
                            <input type="text" value="{{$list->post}}" class="edit_form" name="upPost">
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
