@extends('layouts.login')

@section('content')
<div>
    <ul>
        <li><img src="" alt=""></li>
        <div>
            <div>
                <li>Name</li>
                <li>{{ $list->username }}</li>
            </div>
            <div>
                <li>Bio</li>
                <li>{{ $list->bio }}</li>
            </div>
            <button src="" value="フォローする"></button>
        </div>
    </ul>
</div>

@endsection