# Short Description
All-in-One PHP開発環境 （Ubuntu, Nginx, PHP, PHP-FPM, xdebug, Redis, MySQL）

# Full Description

## ● [Dockerfileは、こちら(GitHub)](https://github.com/maemori/accon/blob/master/docker/ubuntu-nginx-phpfpm-redis-mysql/Dockerfile)

## ● [Dockerfile一式は、こちらからダウンロード](https://kurobuta.jp/download/get/15)

-----

## 1. 概要

PHPのWebアプリケーションに特化したローカル開発環境。  
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

```bash:
mkdir ~/development
mkdir ~/development/workspace
mkdir ~/development/www
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
 -v ~/development:/develop:rw \
 -p 80:80 -p 443:443 -p 3306:3306 \
 -t -i \
 -h develop-server-01 \
 --name develop-server-01 \
 accon/ubuntu-nginx-phpfpm-redis-mysql
```

### 3.3. 動作確認用ファイルの設置

~/public/data-volume/wwwディレクリ配下にindex.phpファイルを配置。

```
echo "<?php phpinfo(); ?>" >  ~/development/www/index.php
```

* index.phpの内容

    ```php
    <?php phpinfo(); ?>
    ```

#### 3.4. 動作確認

下のURLにアクセスしPHPの情報が表示されればOK。

* [http://127.0.0.1](http://127.0.0.1)
* [https://127.0.0.1](https://127.0.0.1)

#### 3.5. MySQLの接続

```bash:
mysql -uDevelop -pTemporary_Password --host 127.0.0.1 --port 3306 development
```

* データベース: development
* ユーザ: Develop
* パスワード: Temporary_Password

#### 3.6. デバッグ

xDebug用にPCのIPアドレスのエイリアスを割り当てる

* Macの場合

```
sudo ifconfig lo0 alias 10.254.254.254
```

* Windowsの場合は、ネットワークと共有センターから

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

* コンテナイメージの一覧

```bash:
docker images
```

-----

## 5. 利用例

### 5.1. [「ubuntu-nginx-phpfpm-redis-mysql」の利用方法（超高速ワードプレス開発環境構築）](https://github.com/maemori/accon/blob/master/docker/ubuntu-nginx-phpfpm-redis-mysql/exsample.md)

-----

## X. コンテナ開発者向け

### X.1. Dockerコンテナイメージの管理

#### X.1.1. ビルド

```bash:
cd ~/Develop/master/accon/v2.0/data-volume/workspace/accon/docker/ubuntu-nginx-phpfpm-redis-mysql/
docker build -t accon/ubuntu-nginx-phpfpm-redis-mysql:1.10 .
```

#### X.1.2. レポジトリにプッシュ

```bash:
# push
docker push accon/ubuntu-nginx-phpfpm-redis-mysql:1.10
# Tag
docker tag accon/ubuntu-nginx-phpfpm-redis-mysql:1.10 accon/ubuntu-nginx-phpfpm-redis-mysql:latest
docker push accon/ubuntu-nginx-phpfpm-redis-mysql:latest
# None images delete
docker images | awk '/<none/{print $3}' | xargs docker rmi
docker images
```

#### X.1.3. コンテナイメージの削除

```
docker rmi accon/ubuntu-nginx-phpfpm-redis-mysql:latest
docker rmi accon/ubuntu-nginx-phpfpm-redis-mysql:1.10
```
