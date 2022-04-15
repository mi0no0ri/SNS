@extends('layouts.login')

@section('content')
<div class="container">
    <h2>Follow List</h2>
        <div class="">
            <div class="">
                @foreach ($all_users as $user)
                    <div class="follow_img">
                        <div class="">
                            <img src="{{ $user->profile_image }}" class="" width="50" height="50">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="">
        </div>
    </div>

@endsection