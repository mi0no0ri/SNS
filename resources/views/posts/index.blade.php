@extends('layouts.login')

@section('content')
<div>
    <div id="tweet">
        {!! Form::open(['url' => 'post/create']) !!}
        <p><img src="../images/dawn.png" alt="プロフィール写真" class="profile_img"></p>
        <div class="form_group">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form_control', 'placeholder' => '何をつぶやこうか...?']) !!}
        </div>
        <input type="image" src="../images/post.png" name="submit" value="投稿する" class="post_btn" href="post/create-form">
        {!! Form::close() !!}
    </div>
    @csrf
    <table>
        <tr>
            <th>投稿者</th>
            <th>投稿内容</th>
            <th>投稿日</th>
        </tr>
        @foreach ($list as $list)
        <tr>
            <td>{{ $list->user_id }}</td>
            <td>{{ $list->post }}</td>
            <td>{{ $list->created_at }}</td>
        </tr>
        @endforeach
    </table>
</div>

@endsection