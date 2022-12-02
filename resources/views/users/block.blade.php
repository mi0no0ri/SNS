@extends('layouts.login')

@section('content')
<p class="block_count">ブロックしているユーザー数：{{ $users->count() }}人</p>
@foreach($users as $user)
<table>
  <ul class="block_list">
    <ul class="blocked_user">
      <li>
        @if(!$user->images)
          <img src="/storage/dawn.png" class="profile_img">
        @else
          <img src="/storage/userIcon/{{$user->images}}" class="profile_img">
        @endif
      </li>
      <li>{{ $user->username }}</li>
    </ul>
    <li>
      <form action="{{ route('unblock', ['user' => $user->blocked_userId]) }}" method="POST">
        {{ csrf_field() }}
        @method('DELETE')
        <button type="submit" class="btn unfollow_set_btn">ブロックを外す</button>
      </form>
    </li>
  </ul>
</table>
@endforeach

@endsection
