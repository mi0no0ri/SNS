# DawnSNS 環境構築手順書

## 構築に必要なもの

- 仮想マシン( 推奨：VirtualBox )
- コマンドソフト
- Vagrantコマンド
- Gitコマンド

## ➀開発用ディレクトリを用意して移動する
```
\Users\ユーザー名
$ mkdir Server8 && cd Server8
```

## ➁Vagrantで、ボックスを追加する
```
\Users\ユーザー名\Server8
$ vagrant box add laravel/homestead
```
※サーバーサイド6章ですでにボックスを用意している方は不要です。

## ➂Gitを使って、homestead構築セットをダウンロードする
homestead構築セットをダウンロードします。
```
\Users\ユーザー名\Server8
$ git clone https://github.com/laravel/homestead.git Homestead
```

ダウンロードが成功したら、作成されたディレクトリへ移動します。
```
\Users\ユーザー名\Server8
$ cd Homestead
```

ブランチを切り替えます。最新のバージョンを利用したい場合は以下のコマンドを入力してください。
```
\Users\ユーザー名\Server8\Homestead
$ git checkout release
```

Homestead環境を初期化して、設置します。
```
\Users\ユーザー名\Server8\Homestead
$ bash init.sh   ←※macの方はこちら
$ init bat       ←※windowsの方はこちら
```

## ➃Homestead.yamlファイルの編集
Homestead.yamlを作成します。
```
\Users\ユーザー名\Server8\Homestead
$ cp Homestead.yaml.example Homestead.yaml
```

作成したHomestead.yamlを開いて、以下の内容に書き換えてください
```
\Users\ユーザー名\Server8\Homestead
$ vim homestead.yaml     ※vimが未対応の場合はviを使う
```

以下の内容に変更する。
```
---
ip: "192.168.10.10"
memory: 2048
cpus: 2
provider: virtualbox

authorize: /Users/ユーザー名/.ssh/id_rsa.pub

keys:
    - /Users/ユーザー名/.ssh/id_rsa

folders:
    - map: /Users/ユーザー名/Server8
      to: /home/vagrant/code

sites:
    - map: homestead.dawn
      to: /home/vagrant/code/dawnSNS/public

databases:
    - homestead

features:
    - mariadb: false
    - ohmyzsh: false
    - webdriver: false

# ports:
#     - send: 50000
#       to: 5000
#     - send: 7777
#       to: 777
#       protocol: udp
```

## ➄仮想マシンの起動
homesteadを立ち上げます。
```
\Users\ユーザー名\Server8\Homestead
$ vagrant up
```

homesteadが起動できたら、SSHでリモート接続に入りましょう。
```
\Users\ユーザー名\Server8\Homestead
$ vagrant ssh
```

※起動やSSH接続がうまくいかない場合は以下のコマンドを実行してから、再度試してみてください。
```
\Users\ユーザー名\Server8\Homestead
ssh-keygen -t rsa
```

SSH接続がうまくいけば、homesteadのOS環境の操作状態へと切り替わります。
```
vagrant@homestead:~$
```

## ➅Laravelを配置する
ダウンロードしてあるLaravel(dawnSNSという名前)のフォルダを、以下のディレクトリに配置してください。
<br>
配置方法は、コマンドでなくても問題ありません。
<br>
※ 圧縮(ZIP)形式のフォルダをそのまま置かないこと
```
\Users\ユーザー名\Server8\
```

以下のように配置されていれば大丈夫です。
```
\Users\ユーザー名\Server8\dawnSNS  ← Laravelのフォルダです
```

## ➆データベースの確認
homestead内のデータベースを確認しておきましょう。
<br>
homesteadという名前のデータベースが存在していれば問題ありません。

SSHでhomesteadの方へ操作を切り替えましょう。
```
\Users\ユーザー名\Server8\Homestead
$ vagrant ssh
```

homestead内のMySQLへログインします。
```
vagrant@homestead:~$mysql -u root -p
password: ←　secretと打ち込む
```

```
mysql: show databases;
↑ 上記コマンドを打って、homesteadが入っていればOKです
```

dawnSNSフォルダの中にある.envファイルを開いて、データベースとの接続設定を確認する
```
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```


## ➇ブラウザ表示の確認まで
SSHでhomesteadの方へ操作を切り替えて、以下のディレクトリに移動します。
```
vagrant@homestead:~$cd code\dawnSNS
```

すでに用意されているテーブル設計を、マイグレーションで作成しましょう。
```
vagrant@homestead:dawnSNS$php artisan migrate
```

以下のURLから、制作途中のログイン画面が表示されていれば成功です。
http://homestead.dawn/login

以降は、homesteadを起動している状態で、dawnSNSフォルダ内の各ファイルの作成,編集をしていきながら、SNSシステムを開発していきましょう。

