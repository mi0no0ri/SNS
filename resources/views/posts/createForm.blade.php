@extends('layouts.login')

@section('content')

<div>
    <div>
        {!! Form::open(['url' => 'post/create']) !!}
        <div class="form_group">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form_control', 'placeholder' => '投稿内容']) !!}
        </div>
        <button type="submit" class="post_btn">追加</button>
        {!! Form::close() !!}
    </div>
</div>

@endsection