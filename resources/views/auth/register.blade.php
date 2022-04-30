@extends('layouts.logout')

@section('content')

{!! Form::open() !!}
<div class="login_page">

<h2 class="top_page">新規ユーザー登録</h2>

<div class="welcome">
{{ Form::label('UserName') }}
{{ Form::text('username',null,['class' => 'input']) }}
</div>

<div class="welcome">
{{ Form::label('MailAddress') }}
{{ Form::text('mail',null,['class' => 'input']) }}
</div>

<div class="welcome">
{{ Form::label('Password') }}
{{ Form::password('password',null,['class' => 'input']) }}
</div>

<div class="welcome">
{{ Form::label('Password confirm') }}
{{ Form::password('password-confirm',null,['class' => 'input']) }}
</div>

<div>
{{ Form::submit('RESISTER',['class' => 'login_btn']) }}
</div>

<p><a href="/login" class="top_page register">ログイン画面へ戻る</a></p>

</div>
{!! Form::close() !!}


@endsection
