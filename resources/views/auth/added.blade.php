@extends('layouts.logout')

@section('content')

<div id="clear" class="login_page added_list">
<p class="added_name">{{ $username }}さん、</p>
<p class="welcome_list">ようこそ！DAWNSNSへ！</p>
<p>ユーザー登録が完了しました。</p>
<p class="welcome_list">さっそく、ログインをしてみましょう。</p>

<p class="btn added_btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection