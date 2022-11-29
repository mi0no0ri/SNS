@extends('layouts.login')

@section('content')

<div>
  @foreach($favorites as $favorite)
    <ul class="post">
        <div id="profile_bar">
            <li id="user_image">
                @if($favorite->user_id == Auth::id())
                <a href="{{route('profile')}}">
                @else
                <a href="{{route('user_profile',['id'=>$favorite->user_id])}}">
                @endif
                @if($favorite->images == null)
                <img src="/storage/dawn.png" class="profile_img">
                @else
                <img src="/storage/userIcon/{{$favorite->images}}" class="profile_img">
                @endif
                </a>
            </li>
            <div id="favorite_icon">
                @if(Auth::check())
                    @if(Auth::user()->favorites()->where('post_id', $favorite->post_id)->exists())
                    <form action="{{ route('unfavorite', $favorite->post_id) }}" method="post">
                        <input type="hidden" name="post_id">
                        @csrf
                        @method('delete')
                        <button type="submit" class="favo_btn">
                            <i class="fas fa-heart"></i>
                        </button>
                    </form>
                    @else
                    <form action="{{ route('favorite', $favorite->post_id) }}" method="post">
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
        <div class="post_favorite">
            <div class="post_head">
                <li class="">{{ $favorite->username }}</li>
                <li class="created_at">{{ $favorite->created_at }}</li>
            </div>
            <li class="post_content" id="post_content">{{ $favorite->post }}</li>
            <div class="post_favorite_btn">
                @if($favorite->user_id == Auth::id())
                <button href="" class="edit_btn modal_btn" data-target="modal{{$favorite->id}}" value="{{$favorite->post}}"><img src="../images/edit.png"></button>
                <li class="delete_button">
                    <a href="/post/{{$favorite->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
                        <img src="../images/trash_h.png" alt="削除" class="delete_btn delete_check">
                        <img src="../images/trash.png" alt="削除" class="delete_btn delete_switch_btn">
                    </a>
                </li>
                @endif
            </div>
        </div>
    </ul>

    <div class="modal_main js_modal modal" id="modal{{$favorite->id}}" aria-labelledby="exampleModalLabel">
        <form action="{{route('update')}}" method="post" id="edit" enctype="multipart/form-data">
            @csrf
            <div class="modal_content">
                <div class="modal_inner">
                    <div class="edit_favorite" id="modal_body">
                        <input type="hidden" value="{{$favorite->id}}" name="id">
                        <input type="text" value="{{$favorite->post}}" class="edit_form" name="upPost">
                    </div>
                </div>
                <div class="edit_confirm_btn">
                    <button type="submit" class="edit_btn modal_close" id="edit_btn"><img src="../images/edit.png"></button>
                </div>
            </div>
        </form>
    </div>
  @endforeach
</div>

@endsection
