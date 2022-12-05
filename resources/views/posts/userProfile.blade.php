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
        </div>
        <div>
            @if(Auth::id() == $list->id)
            <a href="{{ route('profile') }}">プロフィールを編集する</a>
            @else
                @if(Auth::user()->blocks()->where('blocked_userId', $list->id)->exists())
                <form action="{{ route('unblock', ['user' => $list->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn">ブロックを外す</button>
                </form>
                @else
                <form action="{{ route('block', ['user' => $list->id]) }}" method="post">
                    @csrf
                    <button type="submit" class="btn">ブロックする</button>
                </form>
                <div><?php $followings = DB::table('follows')->where('follower_id',Auth::id())->get()->toArray();?>
                    @if(in_array($list->id,array_column($followings,'follow_id') ))
                    <form action="{{ route('unfollow', ['user' => $list->id]) }}" method="POST">
                        {{ csrf_field() }}
                        @method('delete')
                        <button type="submit" class="btn unfollow_btn">フォローを外す</button>
                    </form>
                    @else
                    <form action="{{ route('follow', ['user' => $list->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn follow_btn">フォローする</button>
                    </form>
                    @endif
                </div>
                @endif
            @endif
        </div>
    </ul>

    <div>
        @if(Auth::user()->blocks()->where('blocked_userId', $list->id)->exists())
            <p>このユーザーをブロックしています。</p>
        @else
        <div>
            <div class="profile_switchBar">
                <p id="profile_post">投稿</p>
                <p id="profile_favo">お気に入り</p>
            </div>
            <!-- 投稿 -->
            <div class="profile_post">
                <table>
                    @foreach ($posts as $post)
                    <ul>
                        <div class="profile_postList">
                            <li>
                                <a href="">
                                @if($post->images == null)
                                    <img src="/storage/dawn.png" class="profile_img">
                                @else
                                    <img src="/storage/userIcon/{{$list->images}}" class="profile_img">
                                @endif
                                </a>
                            </li>
                            <div id="favorite_icon">
                                @if(Auth::check())
                                    @if(Auth::user()->favorites()->where('post_id', $post->id)->exists())
                                    <form action="{{ route('unfavorite', $post->id) }}" method="post">
                                        <input type="hidden" name="post_id">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="favo_btn">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('favorite', $post->id) }}" method="post">
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
                        <div class="profile_postList">
                            <div class="">
                                <li class="">{{ $post->username }}</li>
                                <li class="">{{ $post->post }}</li>
                            </div>
                            <li class="">{{ $post->created_at }}</li>
                        </div>
                        <div class="post_list_btn">
                            @if($post->id == Auth::id())
                            <button href="" class="edit_btn modal_btn" data-target="modal{{$post->id}}" value="{{$post->post}}">
                                <img src="../images/edit.png">
                            </button>
                            <li class="delete_button">
                                <a href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
                                    <img src="../images/trash_h.png" alt="削除" class="delete_btn delete_check">
                                    <img src="../images/trash.png" alt="削除" class="delete_btn delete_switch_btn">
                                </a>
                            </li>
                            @endif
                        </div>
                    </ul>
                    @endforeach
                </table>
            </div>
            <!-- お気に入り -->
            @if(Auth::user()->favorites()->where('post_id', $post->id)->get())
            @foreach($favorites as $favorite)
            <ul class="profile_favo disable">
                <div class="profile_postList">
                    <a href="">
                        @if($post->images == null)
                            <img src="/storage/dawn.png" class="profile_img">
                        @else
                            <img src="/storage/userIcon/{{$list->images}}" class="profile_img">
                        @endif
                    </a>
                    <div id="favorite_icon">
                        @if(Auth::check())
                            @if(Auth::user()->favorites()->where('post_id', $post->id)->exists())
                            <form action="{{ route('unfavorite', $post->id) }}" method="post">
                                <input type="hidden" name="post_id">
                                @csrf
                                @method('delete')
                                <button type="submit" class="favo_btn">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </form>
                            @else
                            <form action="{{ route('favorite', $post->id) }}" method="post">
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
                <div class="profile_postList">
                    <div class="">
                        <li class="">{{ $favorite->username }}</li>
                        <li class="" id="post_content">{{ $favorite->post }}</li>
                    </div>
                    <li class="">{{ $favorite->created_at }}</li>
                </div>
                <div class="post_list_btn">
                    @if($favorite->id == Auth::id())
                    <button href="" class="edit_btn modal_btn" data-target="modal{{$favorite->id}}" value="{{$favorite->post}}">
                        <img src="../images/edit.png">
                    </button>
                    <li class="delete_button">
                        <a href="/post/{{$favorite->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
                            <img src="../images/trash_h.png" alt="削除" class="delete_btn delete_check">
                            <img src="../images/trash.png" alt="削除" class="delete_btn delete_switch_btn">
                        </a>
                    </li>
                    @endif
                </div>
            </ul>
            @endforeach
            @endif
            <!-- モーダル -->
            <div class="modal_main js_modal modal" id="modal{{$favorite->id}}" aria-labelledby="exampleModalLabel">
                <form action="{{route('update')}}" method="post" id="edit" enctype="multipart/form-data">
                    @csrf
                    <div class="modal_content">
                        <div class="modal_inner">
                            <div class="edit_list" id="modal_body">
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
        </div>
        @endif
    </div>
</div>

@endsection
