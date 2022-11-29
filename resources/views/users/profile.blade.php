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
                @csrf
                <div>
                <div class="profile_info">
                    {{Form::label('username','UserName')}}
                    {{Form::text('username',$auth->username,['class'=>'form_controls', 'value'=>$auth->username])}}
                    @error('username')
                        <span class="error_msg">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="profile_info">
                    {{Form::label('mail','MailAddress')}}
                    {{Form::email('mail',$auth->mail,['class'=>'form_controls', 'value'=>$auth->mail])}}
                    @error('mail')
                        <span class="error_msg">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="profile_info">
                    {{Form::label('password','Password')}}
                    {{Form::password('password',['class'=>'form_controls password', 'disabled value'=>'●●●●●●●'])}}
                </div>
                <div class="profile_info">
                    {{Form::label('password','new Password')}}
                    {{Form::password('password',['class'=>'form_controls', 'value'=>encrypt($auth->password)])}}
                    @error('password')
                        <span class="error_msg">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="profile_info">
                    {{Form::label('bio','Bio')}}
                    {{Form::text('bio',$auth->bio,['class'=>'form_controls', 'value'=>$auth->bio])}}
                    @error('bio')
                        <span class="error_msg">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="profile_info image_info">
                    <form action="{{route('profileUpdate')}}" method="PUT" enctype=multipart/form-data>
                    @csrf
                    <label for="images">Icon Image
                        <div class="image_label">
                            <p class="file_image">ファイルを選択</p>
                            <input type="hidden" name="id" value="{{$auth->id}}">
                            <input type="file" name="images" class="form_controls image_control" id="images">
                        </div>
                    </label>
                        @error('images')
                        <span class="error_message">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                </div>
            </ul>
            <div class="submit_btn">
            {{Form::submit('更新する',['class'=>'btn btn-success'])}}
            </div>
            </form>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
