@extends('layouts.app_admin')

@section('content')

{!! Form::open() !!}

<p class="top_page social">Social Network Service</p>

<div class="login_page">
<p class="top_page">DAWNSNS -管理者ページ- へようこそ</p>

<div class="welcome">
    {{ Form::label('MailAddress',) }}
    {{ Form::text('email',null,['class' => 'input']) }}
</div>
<div class="welcome">
    {{ Form::label('Password') }}
    {{ Form::password('password',['class' => 'input']) }}
</div>

{{ Form::submit('LOGIN',['class' => 'login_btn btn']) }}

<p class="register top_page"><a href="register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}
</div>

@endsection
