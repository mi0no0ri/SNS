@extends('layouts.app_admin')

@section('content')

    {!! Form::open(['route' => ['register','admin.added'],'method' => 'POST','enctype' => 'multipart/form-data']) !!}
    @csrf
        <div class="login_page">
            <p class="top_page">新規ユーザー登録</p>
                <div class="welcome">
                    {{ Form::label('name','Name') }}
                    {{ Form::text('name',null,['class' => 'input']) }}
                    @error('name')
                        <span class="error_massage">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="welcome">
                    {{ Form::label('email','MailAddress') }}
                    {{ Form::email('email',null,['class' => 'input']) }}
                    @error('email')
                        <span class="error_massage">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="welcome">
                    {{ Form::label('password','Password') }}
                    {{ Form::password('password',null,['class' => 'input']) }}
                    @error('password')
                        <span class="error_massage">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="welcome">
                    {{ Form::label('password','Password confirm') }}
                    {{ Form::password('password-confirm',null,['class' => 'input']) }}
                    @error('password')
                        <span class="error_massage">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    {{Form::submit('RESISTER',['class'=>'btn login_btn'])}}
                </div>
            <p><a href="login" class="top_page register">ログイン画面へ戻る</a></p>
        </div>
    {!! Form::close() !!}

@endsection
