This software is released under the MIT License, see LICENSE.txt.

# 構成
 * Ubuntu 14.04.2 LTS (日本語対応)
 * Openssl 1.0.1f-1
 * Nginx 1.4.6
 * PHP 5.5.9
 * PHP-FPM 5.5.9
 * xdebug 2.2.3
 * Redis 2.2.4
 * MySQL 5.5.43
# Ubuntu, Openssl, Nginx, PHP, PHP-FPM, xdebug, Redis, MySQL

## Data Volume ディレクトリの作成
```bash:
mkdir -p ~/Public/data-volume/data
mkdir -p ~/Public/data-volume/workspace
mkdir -p ~/Public/data-volume/www

```

* ~/Public/data-volume/dataディレクトリに「database.sql」「tables.sql」が存在しないと起動しません。
[1.3.MySQLのデータベース作成用ファイル置き場](https://registry.hub.docker.com/u/accon/ubuntu-nginx-phpfpm-redis-mysql/)を参考にデータベースの準備を起動前に行ってください。

## iOS:コンテナの起動（バックグラウンドでLNMPを起動）
```bash:
docker run -d \
 -v ~/Develop/master/data-volume/data:/develop/data:rw \
 -v ~/Develop/master/data-volume/workspace:/develop/workspace:rw \
 -v ~/Develop/master/data-volume/www:/develop/www:rw \
 -p 80:80 \
 -p 443:443 \
 -p 3306:3306 \
 -p 9901:9001 \
 -t -i \
 -h dev-server-01 \
 --name dev-server-01 \
 accon/ubuntu-nginx-phpfpm-redis-mysql:2.00
```
 
## iOS:コンテナの起動（LNMPを起動せず、後で手動で起動）
```bash:
docker run -d \
 -v ~/Develop/master/data-volume/data:/develop/data:rw \
 -v ~/Develop/master/data-volume/workspace:/develop/workspace:rw \
 -v ~/Develop/master/data-volume/www:/develop/www:rw \
 -p 80:80 \
 -p 443:443 \
 -p 3306:3306 \
 -p 9101:9001 \
 -t -i \
 -h dev-server-01 \
 --name dev-server-01 \
 accon/ubuntu-nginx-phpfpm-redis-mysql:2.00 \
 /bin/bash
```

docker build -t accon/ubuntu-nginx-phpfpm-redis-mysql:2.00 .

docker run -d  -v ~/Develop/master/data-volume/data:/develop/data:rw  -v ~/Develop/master/data-volume/workspace:/develop/workspace:rw  -v ~/Develop/master/data-volume/www:/develop/www:rw  -p 80:80  -p 443:443  -p 3306:3306  -p 9101:9001  -t -i  -h dev-server-01  --name dev-server-01  accon/ubuntu-nginx-phpfpm-redis-mysql:2.00  /bin/bash

docexec -it dev-server-01 bash
docker stop dev-server-01
docker rm dev-server-01

```bash:
docker run -d \
 -v ~/Develop/master/data-volume/data:/develop/data:rw \
 -v ~/Develop/master/data-volume/workspace:/develop/workspace:rw \
 -v ~/Develop/master/data-volume/www:/develop/www:rw \
 -p 80:80 \
 -p 443:443 \
 -p 3306:3306 \
 -p 9001:9001 \
 -t -i \
 -h dev-server-01 \
 --name dev-server-01 \
 accon/ubuntu-nginx-phpfpm-redis-mysql \
 /bin/bash
```

## コンテナのスタート
```bash:
docker start dev-server-01
```

## コンテナのストップ
```bash:
docker stop dev-server-01
```

## コンテナの削除
```bash:
docker rm dev-server-01
```

## コンテナのコンソールに接続
```bash:
docker exec -it dev-server-01 bash
#サービスの起動
/etc/service/run
```

## コンテナのストップ
```bash:
docker attach dev-server-01
```

-----

## ビルド
```bash:
docker build -t accon/ubuntu-nginx-phpfpm-redis-mysql:2.00 .
```

# レポジトリにプッシュ
```bash:
docker push accon/ubuntu-nginx-phpfpm-redis-mysql:1.03
# TAG付け
docker tag imageId accon/ubuntu-nginx-phpfpm-redis-mysql:latest
docker push accon/ubuntu-nginx-phpfpm-redis-mysql:latest
```

# 操作

## イメージ
 * 一覧    : docker images
 * 削除    : docker rmi [name]

## コンテナ
 * 一覧    : docker ps -a
 * 起動    : docker start [name]
 * 終了    : exit (コンソールで実行)
 * デタッチ : Ctrl+P Ctrl+Q (コンソールで実行)
 * アタッチ : docker attach [name]
 * 停止    : docker stop [ID]
 * 削除    : docker rm [name]
 * 全て削除 : docker rm `docker ps -a -q`
