<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
        <h1><a href="/top"><img src="images/main_logo.png" class="image"></a></h1>
            <dl id="">
                <dt class="toggle_contents">
                    <dt class="ac_title"><span><?php $user = Auth::user();?>{{ $user->username }}　さん<!-- <img class="" src="images/arrow.png">--></span></dt>
                    <dd class="ac_child"><a href="/top">ホーム</a></dd>
                    <dd class="ac_child"><a href="/profile">プロフィール編集</a></dd>
                    <dd class="ac_child"><a href="/logout">ログアウト</a></dd>
                    <!-- <li class=""><a href="/top">ホーム</a></li>
                    <li class=""><a href="/profile">プロフィール編集</a></li>
                    <li class=""><a href="/logout">ログアウト</a></li> -->
                </dt>
            </dl>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p><?php $user = Auth::user();?>{{ $user->username }}さんの</p>
                <div class="follow">
                <p>フォロー数</p>
                <p>名</p>
                </div>
                <p class="btn"><a href="/follow">フォローリスト</a></p>
                <div>
                <p>フォロワー数</p>
                <p>名</p>
                </div>
                <p class="btn"><a href="/follower">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
    <script type="text/javascript" src="acordion.js"></script>
</body>
</html>