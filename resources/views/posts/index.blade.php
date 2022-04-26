@extends('layouts.login')

@section('content')
<div>
    <div id="tweet">
        {!! Form::open(['url' => 'post/create']) !!}
        <p><img src="storage/dawn.png" alt="プロフィール写真" class="profile_img"></p>
        <div class="form_group">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form_control', 'placeholder' => '何をつぶやこうか...?']) !!}
        </div>
        <input type="image" src="../images/post.png" name="submit" value="投稿する" class="post_btn" href="post/create-form">
        {!! Form::close() !!}
    </div>
    @csrf
    <table>
        @foreach ($list as $list)
        <ul class="post_list">
            <li><a href=""><img src="/storage/dawn.png" alt="NO IMAGE" class="profile_image"></a></li>
            <div class="post_head">
                <li class="">{{ $list->username }}</li>
                <li class="created_at">{{ $list->created_at }}</li>
            </div>
            <li class="post_content">{{ $list->post }}</li>
            <div class="post_list_btn">
                <li><a href="/post/{{$list->id}}/update-form" class="edit_btn"><img src="../images/edit.png" alt="編集"></a></li>
                <li><a href="/post/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"><img src="../images/trash_h.png" alt="削除" class="delete_btn"></a></li>
            </div>
        </ul>
        @endforeach
    </table>
</div>

@endsection