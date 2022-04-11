@extends('layouts.login')

@section('content')

<div class="card-body">
     <div class="search">
        <form method="post" action="result" class="form">
            <div class="word">
                <input type="text" name="search_word" placeholder="ユーザー名" class="search_bar">
            </div>
            <input type="image" src="../images/search.png" name="submit" value="送信する" class="search_btn">
            @csrf
        </form>
    </div>
</div>

@endsection