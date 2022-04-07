@extends('layouts.login')

@section('content')

<!-- <div class="card-header">
    ユーザー検索
</div> -->
<div class="card-body">
    <!-- <p>検索したいユーザーの情報を入力してください。</p> -->
     <div class="search">
        <form method="post" action="result" class="form">
            <!-- <div class="category">
                <p>検索項目: </p>
                <select name="search_category">
                    <option value="0" selected>選択してください</option>
                </select>
            </div> -->
            <div class="word">
                <!-- <p>検索ワード: </p> -->
                <input type="text" name="search_word">
            </div>
            <input type="image" src="../images/search.png" name="submit" value="送信する" class="search_btn">
            @csrf
        </form>
    </div>

@endsection