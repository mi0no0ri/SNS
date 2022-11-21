@extends('layouts.app_admin')

@section('content')

<div id="clear" class="login_page added_list">
<p class="added_name">{{ $name }}さん、</p>
<p class="welcome_list">ようこそ！DAWNSNS 管理者ページへ！</p>
<p>ユーザー登録が完了しました。</p>
<p class="welcome_list">さっそく、ログインをしてみましょう。</p>

<p class="btn added_btn"><a href="admin/login">ログイン画面へ</a></p>
</div>

@endsection
