@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>新規ユーザー登録</h2>

{{ Form::label('UserName') }}
{{ Form::text('username',null,['class' => 'input']) }}

{{ Form::label('MailAddress') }}
{{ Form::text('mail',null,['class' => 'input']) }}

{{ Form::label('Password') }}
{{ Form::password('password',null,['class' => 'input']) }}

{{ Form::label('Password confirm') }}
{{ Form::password('password-confirm',null,['class' => 'input']) }}

{{ Form::submit('RESISTER') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
