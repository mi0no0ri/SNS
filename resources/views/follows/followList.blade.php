@extends('layouts.login')

@section('content')
<div class="follow_container">
    <h2 class="follow_title">Follow List</h2>
        <div class="">
            <div class="follow_img">
                @foreach ($all_users as $user)
                    <ul>
                        <li><a href=""><img src="{{ $user->profile_image }}" class="profile_img" width="50" height="50"></a></li>
                    </ul>
                @endforeach
            </div>
        </div>
        <div class="">
        </div>
    </div>

@endsection