This software is released under the MIT License, see LICENSE.txt.

# 【概要】
## FuelPHPをベースとしたWebアプリケーション開発・実行基盤
### データベースの使用とアクセス制御が必要なWebアプリケーションの開発工数を90%OFFすることが可能! (*1)

# 【構成】
* ベース・コンテナ [ubuntu-nginx-phpfpm-redis-mysql](https://registry.hub.docker.com/u/accon/ubuntu-nginx-phpfpm-redis-mysql/ accon/ubuntu-nginx-phpfpm-redis-mysql)
* FuelPHP 1.7.3 + [ACCON](https://kurobuta.jp/treebooks/book/manual/accon/ ACCON) 1.0（データベースの利用とアクセス制御が必要なWebアプリケーションの基本機能を提供するモジュール）

-----
# 【 [Dockerfile一式はこちらからダウンロード](https://kurobuta.jp/download/view/17 Dockerfile一式) 】

-----
# 【イメージの取得】
```bash:
docker pull accon/fuelphp-accon
```

-----

# 【利用手順】
## 1.ローカルにData Volume（共有ディレクトリ）の「workspace」と「data」 ディレクトリを作成
```bash:
mkdir ~/Develop
mkdir ~/Develop/data-volume
mkdir ~/Develop/data-volume/workspace
mkdir ~/Develop/data-volume/data
```

パスは任意ですが、OSのユーザのホームディレクトリ配下である必要があります。（パスを変更した場合は、下の「docker run」の内容(-v)を合わせて変更してください）  
初回起動時（「docker run」）に上のディレクトリにプロジェクトが設置されます。
  * workspaceディレクトリ：FuelPHP+ACCONのプロジェクトが配置されます。（Xdebugのポートは9000）
  * dataディレクトリ：データベースの作成用と初期データ用のSQLファイルが配置されます。（「docker run」に実行）

  初回起動は多少の時間が掛かります。起動後、ブラウザでアクセスするとサンプルアプリの稼働を確認できます。

## 2.コンテナの起動（バックグラウンドでFuelPHP+ACCONを起動）

### 2.1.iOSの場合
```bash:
docker run -d \
 -v ~/Develop/data-volume/data:/develop/data:rw \
 -v ~/Develop/data-volume/workspace:/develop/workspace:rw \
 -p 80:80 \
 -p 443:443 \
 -p 3306:3306 \
 -p 9090:9000 \
 -t -i \
 -h project-server-01 \
 --name project-server-01 \
 accon/fuelphp-accon
```

### 2.1.Windowsの場合
```bash:
docker run -d -v /c/Users/[ユーザID]/Develop/data-volume/data:/develop/data:rw -v /c/Users/[ユーザID]/develop/data-volume/workspace:/develop/workspace:rw -p 80:80 -p 443:443 -p 3306:3306 -p 9000:9000 -t -i -h project-server-01 --name project-server-01 accon/fuelphp-accon
```

## 3.起動の確認
Kitematicからコンテナ「project-server-01」を選択し、画面右側の「WEB PREVIEW」をクリックすることにより該当のURLが指定された状態でブラウザが起動します。
「Welcome」の画面が表示されれば必要なミドルウェアが起動し、アプリケーションが正常に動作している状態です。  

* サーバー証明書が自己証明書のため初めてブラウザでアクセスした場合、セキュリティの警告が出ますが開発には問題ありません。アクセスを許可してご利用ください。

## 4.各ミドルウェアの起動と停止
コンテナをrun時、下のミドルウェアは全て起動した状態となっております。
また、起動と停止はsshで接続して行います。（本番環境ではsshをコンテナに導入することは推奨しません）  

### サーバーに接続
```
docker exec -it project-server-01 bash
```

### サーバーに接続（ssh）
sshのポートは「2222」です。developユーザでログインしてください。（パスワードはdevelop）
```bash:
ssh -p 2222 develop@192.168.99.101 
```
下の起動停止は上のsshで接続を行って実行します。  

### HTTPサーバー（Nginx）
* 起動：sudo service nginx start
* 停止：sudo service nginx stop

### データベース（MySQL）
* 起動：sudo service mysql start
* 停止：sudo service mysql stop

### PHP-FPM
* 起動：sudo service php5-fpm start
* 停止：sudo service php5-fpm stop

### KVS（Redis）
* 起動：sudo service redis-server start
* 停止：sudo service redis-server stop

### ssh
* 起動：sudo service ssh start
* 停止：sudo service ssh stop

## 5.Webアプリケーションの開発方法
コンテナ内で稼働しているWebアプリケーションのプロジェクトファイルは、ホストOSのローカルのホームディレクトリ配下の「Develop/data-volume/workspace」と共有しています。それらをPhpStormやEclips、テキストエディタで変更することで即座にWebアプリケーションに反映されます。

## 6.リモートデバッグ方法
Xdebugが有効な状態で起動しています。Xdebugの接続ポート番号は「9000」。

-----
## コンテナのスタート
```bash:
docker start project-server-01
```
## コンテナのコンソールに接続
```bash:
docker exec -it project-server-01 bash
```

## コンテナのストップ
```bash:
docker attach project-server-01
```
-----
##
# fuelphp-accon
#
#  用途: FuelPHP 開発・実行基盤
#  構成: image[ubuntu-nginx-phpfpm-redis-mysql] + FuelPHP(1.7.3) + ACCON(1.0)
#
# Part of the ACCON.
#
# Copyright (c) 2015 Maemori Fumihiro
# This software is released under the MIT License.
# http://opensource.org/licenses/mit-license.php
#
# @version    1.03
# @author     Maemori Fumihiro
# @link       https://kurobuta.jp
FROM accon/ubuntu-nginx-phpfpm-redis-mysql:1.03
MAINTAINER Maemori Fumihiro

# インストール
RUN mkdir -p /develop/archive
## FuelPHPの設置
RUN curl -k http://fuelphp.com/files/download/34 > /develop/archive/fuelphp.zip
RUN unzip /develop/archive/fuelphp.zip -d /develop/archive/workspace
RUN mv /develop/archive/workspace/fuelphp-1.7.3 /develop/archive/workspace/project

# 設定
ADD module/fuelphp-accon /etc/service/fuelphp-accon
RUN chmod +x /etc/service/fuelphp-accon
# HTTPはHTTPSへリダイレクト
ADD conf/default /etc/nginx/sites-available/default

# 起動
CMD ["/etc/service/fuelphp-accon"]
```

-----
(*1): 開発対象の特性、外的要因、開発者の熟練度により変動します

-----

## ビルド
```bash:
cd ~/develop/master/data-volume/workspace/kurobuta.jp/docker/accon/fuelphp-accon
docker build -t accon/fuelphp-accon:1.03 .
```

# レポジトリにプッシュ
```bash:
docker push accon/fuelphp-accon:1.03
# TAG付け
docker tag -f imageId accon/fuelphp-accon:latest
docker push accon/fuelphp-accon:latest
```

# 操作

## イメージ
 * 一覧    : docker images
 * 削除    : docker rmi [ID]

## コンテナ
 * 一覧    : docker ps -a
 * 起動    : docker start [ID]
 * 終了    : exit (コンソールで実行)
 * デタッチ : Ctrl+P Ctrl+Q (コンソールで実行)
 * アタッチ : docker attach [ID]
 * 停止    : docker stop [ID]
 * 削除    : docker rm [ID]
 * 全て削除 : docker rm `docker ps -a -q`
