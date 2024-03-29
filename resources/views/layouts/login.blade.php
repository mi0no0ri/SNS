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
    <script src="https://kit.fontawesome.com/eea364082e.js" crossorigin="anonymous"></script>
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
        <h1><a href="/top"><img src="/images/main_logo.png" class="image" id="image"></a></h1>
        <nav>
            <div class="accordion_menu" id="accordion_menu">
                <h3 class="ac_title" data-target="hidden">
                    <span><?php $user = Auth::user();?>{{ $user->username }} さん</span>
                    @if($user->images == null)
                    <img src="/storage/dawn.png" class="profile_img">
                    @else
                    <img src="/storage/userIcon/{{$user->images}}" class="profile_img">
                    @endif
                </h3>
                <ul id="hidden">
                    <li class="ac_child"><a href="/top" class="ac_child">ホーム</a></li>
                    <li class="ac_child"><a href="{{ route('notice') }}" class="ac_child">お知らせ一覧</a></li>
                    <li class="ac_child"><a href="{{ route('profile') }}" class="ac_child">プロフィール編集</a></li>
                    <li class="ac_child"><a href="/logout" class="ac_child">ログアウト</a></li>
                </ul>
            </div>
        </nav>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p id="name"><?php $user = Auth::user();?>{{ $user->username }}さんの</p>
                <div class="population">
                    <p>フォロー数</p>
                    <p><?php $follows = DB::table('follows'); ?>
                    {{ $follows->where('follower_id', '=', Auth::id())->count() }} 名</p>
                </div>
                <p class="btn followList_btn"><a href="/followList" class="inner">フォローリスト</a></p>
                <div class="population">
                    <p>フォロワー数</p>
                    <p><?php $follows = DB::table('follows'); ?>
                    {{ $follows->where('follow_id', '=', Auth::id())->count() }} 名</p>
                </div>
                <p class="btn followerList_btn"><a href="/follower" class="inner">フォロワーリスト</a></p>
            </div>
            <p class="btn user_search"><a href="/search" class="inner">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="/js/accordion.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</body>
</html>
