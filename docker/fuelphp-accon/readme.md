# Short Description
FuelPHP+ACCON 開発・実行基盤　[Docker image:ubuntu-nginx-phpfpm-redis-mysql(1.10)] + FuelPHP(1.8) + ACCON(1.10)

# Full Description

## ● [Dockerfileは、こちら(GitHub)](https://github.com/maemori/accon/blob/master/docker/fuelphp-accon/Dockerfile)

## ● [Dockerfile一式は、こちらからダウンロード](https://kurobuta.jp/download/view/17)

-----

## 1. 概要

FuelPHPをベースとしたWebアプリケーション開発・実行基盤  
データベースの使用とアクセス制御が必要なWebアプリケーションの開発用

### 1.1.【構成】

* ベース・コンテナ [ubuntu-nginx-phpfpm-redis-mysql](https://registry.hub.docker.com/u/accon/ubuntu-nginx-phpfpm-redis-mysql/ accon/ubuntu-nginx-phpfpm-redis-mysql)
* FuelPHP 1.8 + [ACCON](https://kurobuta.jp/books/book/manual/accon/) 1.1（データベースの利用とアクセス制御が必要なWebアプリケーションの基本機能を提供するモジュール）

-----

### 1.2.【イメージの取得】

```bash:
docker pull accon/fuelphp-accon
```

-----

## 2.【利用手順】

### 2.1. ローカルに「Data Volume」（共有ディレクトリ）ディレクトリを作成

```bash:
mkdir -p ~/productment/workspace
```

パスは任意ですが、OSユーザのホームディレクトリ配下である必要があります。（パスを変更した場合は、下の「docker run」の内容(-v)を合わせて変更してください）  
初回起動時（「docker run」）に上のディレクトリにプロジェクトが設置されます。  

  * workspaceディレクトリ：FuelPHP+ACCONのプロジェクトが配置されます。

初回起動は多少の時間が掛かります。起動後、ブラウザでアクセスするとサンプルアプリの稼働を確認できます。

### 2.2. コンテナの起動（バックグラウンドでFuelPHP+ACCONを起動）

```bash:
docker run -d \
 -v ~/productment/workspace:/develop/workspace:rw \
 -p 80:80 -p 443:443 -p 3306:3306 \
 -t -i \
 -h product-server-01 \
 --name product-server-01 \
 accon/fuelphp-accon
```

### 2.3. 起動の確認

* [http://127.0.0.1](http://127.0.0.1)
* サーバー証明書が自己証明書のため初めてブラウザでアクセスした場合、セキュリティの警告が出ますが開発には問題ありません。アクセスを許可してご利用ください。

### 2.4. MySQLの接続方法

```bash:
mysql -u service_admin -p --host 127.0.0.1 --port 3306 service_db
```

* データベース: service_db
* ユーザ: service_admin
* パスワード: ServiceAdmin@P2W0rd

-----

## 3. よく使うDockerコンテナを制御するコマンド

* コンテナのコンソールに接続
```bash:
docker exec -it product-server-01 bash
```

* コンテナのスタート
```bash:
docker start product-server-01
```

* コンテナのストップ
```bash:
docker stop product-server-01
```

* コンテナの削除
```bash:
docker rm product-server-01
```

* 起動中コンテナの確認
```bash:
docker ps
```

* 全てのコンテナの確認
```bash:
docker ps -a
```

* 取得したモジュール一式をリセット
```bash:
rm -Rf ~/productment/workspace/product
```

-----

## 3. Webアプリケーションの開発方法

コンテナ内で稼働しているWebアプリケーションのプロジェクトファイルは、ホストOSのローカルのホームディレクトリ配下の「productment/workspace」と共有しています。  
それらをPhpStormやEclips、テキストエディタで変更することで即座にWebアプリケーションに反映されます。

-----

## 6. リモートデバッグ方法

Xdebugが有効な状態で起動しています。Xdebugの接続ポート番号は「9000」。  
また、環境によってはxDebug用にPCのIPアドレスのエイリアスを割り当てる

* Macの場合

```
sudo ifconfig lo0 alias 10.254.254.254
```

* Windowsの場合は、ネットワークと共有センターから使用しているネットワークのTCP/IP(IPv4)に10.254.254.254を追加します

-----

## 5.各ミドルウェアの起動と停止

コンテナを起動時、下のミドルウェアは全て起動した状態となっております。

### HTTPサーバー（Nginx）

* 起動： service nginx start
* 停止： service nginx stop

### データベース（MySQL）

* 起動： service mysql start
* 停止： service mysql stop

### PHP-FPM

* 起動： service php7.0-fpm start
* 停止： service php7.0-fpm stop

### Redis

* 起動： service redis-server start
* 停止： service redis-server stop


-----

## X. コンテナ開発者向け

### X.1. Dockerコンテナイメージの管理

#### X.1.1. ビルド

```bash:
cd ~/Develop/master/accon/v2.0/data-volume/workspace/accon/docker/fuelphp-accon
docker build -t accon/fuelphp-accon:1.10 .
```

#### X.1.2. レポジトリにプッシュ

```bash:
# push
docker push accon/fuelphp-accon:1.10
# Tag
docker tag accon/fuelphp-accon:1.10 accon/fuelphp-accon:latest
docker push accon/fuelphp-accon:latest
# None images delete
docker images | awk '/<none/{print $3}' | xargs docker rmi
docker images
```

#### X.1.3. コンテナイメージの削除

```
docker rmi accon/fuelphp-accon:latest
docker rmi accon/fuelphp-accon:1.10
```
