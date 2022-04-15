<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Dawnが提供するSNSサービスです">
    <title>DawnSNS</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png">
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png">
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png">
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png">
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="images/favicon.png">
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
        <h1><a href="/top"><img src="/images/main_logo.png" class="image"></a></h1>
            <div class="accordion_menu">
                <h3 class="ac_title"><span><?php $user = Auth::user();?>{{ $user->username }}　さん<!-- <img class="" src="images/arrow.png">--></span></h3>
                <ul class="hidden">
                    <li class="ac_child"><a href="/top">ホーム</a></li>
                    <li class="ac_child"><a href="/profile">プロフィール編集</a></li>
                    <li class="ac_child"><a href="/logout">ログアウト</a></li>
                </ul>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p id="username"><?php $user = Auth::user();?>{{ $user->username }}さんの</p>
                <div class="population">
                    <p>フォロー数</p>
                    <p>名</p>
                </div>
                <p class="btn follow_btn"><a href="/followList" class="inner">フォローリスト</a></p>
                <div class="population">
                    <p>フォロワー数</p>
                    <p>名</p>
                </div>
                <p class="btn follow_btn"><a href="/follower" class="inner">フォロワーリスト</a></p>
            </div>
            <p class="btn user_search"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/accordion.js"></script>
</body>
</html>