# Short Description
All-in-One PHP開発環境 （Ubuntu, Nginx, PHP, PHP-FPM, xdebug, Redis, MySQL）

# Full Description

## ○[Dockerfileは、こちら(GitHub)](https://github.com/maemori/accon/blob/master/docker/ubuntu-nginx-phpfpm-redis-mysql/Dockerfile)

## ○[Dockerfile一式は、こちらからダウンロード](https://kurobuta.jp/download/get/15)

-----

## 1. 概要

PHP・Webアプリケーションに特化したローカル開発環境。  
ローカルPCの開発用ディレクトリをDockerコンテナと共有し、そのUbuntu上で実行・開発・デバッグを行うための環境。

## 2. 構成バージョン

 * Ubuntu: 16.10 LTS (日本語対応)
 * Nginx: 1.10
 * PHP: 7.0
 * MySQL: 5.7
 * PHP-FPM: 7.0
 * xdebug: 2.4
 * Redis: 3.2

## 3. 利用方法

### 3.1. ローカルPCにDockerコンテナと共有するディレクトリを作成

``` bash:
mkdir -p ~/public/data-volume/workspace
mkdir ~/public/data-volume/www
```

 * data-volumeディレクトリ(配置場所はHOMEディレクトリ配下の任意の場所)  
  Dockerコンテナの/developディレクトリにマウントされます。

 * data-volume/workspaceディレクトリ  
  Webアプリケーションのプロジェクトを配置します。

 * data-volume/wwwディレクトリ  
  Webアプリケーションの公開ファイルを配置します。  

### 3.2. Dockerコンテナの取得と起動

```bash:
docker run -d \
 -v ~/public/data-volume:/develop:rw \
 -p 80:80 \
 -p 443:443 \
 -p 3901:3306 \
 -p 9901:9001 \
 -t -i \
 -h develop-server-01 \
 --name develop-server-01 \
 accon/ubuntu-nginx-phpfpm-redis-mysql
```

### 3.4. 動作確認用ファイルの設置

~/public/data-volume/wwwディレクリ配下にindex.phpファイルを配置。

* index.phpの内容

    ```php
    <?php phpinfo();
    ```

#### 3.5. 動作確認

下のURLにアクセスしPHPの情報が表示されればOK。

* [http://127.0.0.1](http://127.0.0.1)
* [https://127.0.0.1](https://127.0.0.1)

## 4. よく使うDockerコンテナを制御するコマンド

* コンテナのコンソールに接続
```bash:
docker exec -it develop-server-01 bash
```

* コンテナのスタート
```bash:
docker start develop-server-01
```

* コンテナのストップ
```bash:
docker stop develop-server-01
```

* コンテナの削除
```bash:
docker rm develop-server-01
```

* 起動中コンテナの確認
```bash:
docker ps
```
* 全てのコンテナの確認
```bash:
docker ps -a
```

-----

# 開発者向け

## レポジトリにプッシュ

```bash:
# push
docker push accon/ubuntu-nginx-phpfpm-redis-mysql:1.10
# Tag
docker tag [imageId] accon/ubuntu-nginx-phpfpm-redis-mysql:latest
docker push accon/ubuntu-nginx-phpfpm-redis-mysql:latest
```

## Dockerコンテナ・イメージの操作

### ローカルPCにDockerコンテナと共有するディレクトリを作成

``` bash:
mkdir -p ~/Develop/master/accon/v2.0/data-volume/workspace
mkdir ~/Develop/master/accon/v2.0/data-volume/www
```

### ビルド

```bash:
cd ~/Develop/master/accon/v2.0/data-volume/workspace/accon/docker/ubuntu-nginx-phpfpm-redis-mysql/
docker build -t accon/ubuntu-nginx-phpfpm-redis-mysql:1.10 .
```

### コンテナイメージの確認
```
docker images
```

### コンテナイメージの削除
```
docker rmi accon/ubuntu-nginx-phpfpm-redis-mysql:2.00
```

### コンテナの起動:

```bash:
docker run -d \
 -v ~/Develop/master/accon/v2.0/data-volume:/develop:rw \
 -p 80:80 \
 -p 443:443 \
 -p 3306:3306 \
 -p 9901:9001 \
 -t -i \
 -h develop-server-01 \
 --name develop-server-01 \
 accon/ubuntu-nginx-phpfpm-redis-mysql:1.10
```

## コマンド
 * 一覧    : docker ps -a
 * 起動    : docker start [name]
 * 終了    : exit (コンソールで実行)
 * デタッチ : Ctrl+P Ctrl+Q (コンソールで実行)
 * アタッチ : docker attach [name]
 * 停止    : docker stop [ID]
 * 削除    : docker rm [name]
 * 全て削除 : docker rm `docker ps -a -q`
