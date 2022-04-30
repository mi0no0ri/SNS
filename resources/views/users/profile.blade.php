@extends('layouts.login')

@section('content')
    <div>
        <div class="profile_page">
            <ul class="profile_list">
                <li>
                    @if($auth->images == null)
                    <img src="/storage/dawn.png" class="profile_img">
                    @else
                    <img src="/storage/userIcon/{{$auth->images}}" class="profile_img">
                    @endif
                </li>
                {!! Form::open(['route' => ['profileUpdate'],'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                {!! Form::hidden('id',$auth->id) !!}
                <div>
                <div class="profile_info">
                    {{Form::label('username','UserName')}}
                    {{Form::text('username',$auth->username,['class'=>'form_controls', 'id'=>'username', 'value'=>$auth->username])}}
                    <span>{{$errors->first('username')}}</span>
                </div>
                <div class="profile_info">
                    {{Form::label('mail','MailAddress')}}
                    {{Form::email('mail',$auth->mail,['class'=>'form_controls', 'id'=>'mail', 'value'=>$auth->mail])}}
                    <span>{{$errors->first('mail')}}</span>
                </div>
                <div class="profile_info">
                    {{Form::label('password','Password')}}
                    {{Form::password('password',['class'=>'form_controls', 'id'=>'password', 'disabled value'=>$auth->password])}}
                </div>
                <div class="profile_info">
                    {{Form::label('password','new Password')}}
                    {{Form::password('password',['class'=>'form_controls', 'id'=>'password', 'value'=>$auth->password])}}
                    <span>{{$errors->first('password')}}</span>
                </div>
                <div class="profile_info">
                    {{Form::label('bio','Bio')}}
                    {{Form::text('bio',$auth->bio,['class'=>'form_controls', 'id'=>'bio', 'value'=>$auth->bio])}}
                </div>
                <div class="profile_info ">
                    {{Form::label('images','Icon Image')}}
                    {{Form::file('images',['class'=>'form_controls', 'id'=>'images'])}}
                </div>
                </div>
            </ul>
            <div class="submit_btn">
            {{Form::submit('更新する',['class'=>'btn btn-success'])}}
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection