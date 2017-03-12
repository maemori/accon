# Memo
https://taigaio.github.io/taiga-doc/dist/setup-development.html
https://github.com/htdvisser/taiga-docker

# Short Description
Scrum開発管理用サーバー（TAIGA）

# Full Description

## ● [Dockerfileは、こちら(GitHub)](https://github.com/maemori/accon/blob/master/docker/taiga/Dockerfile)

## ● [Dockerfile一式は、こちらからダウンロード](https://kurobuta.jp/download/get/XX)

-----

## 1. 概要

アジャイルプロジェクト管理ツール.

## 2. 構成バージョン

 * Ubuntu: 16.10 LTS (日本語対応)
 * Nginx: 1.10
 * Python: 3.5
 * PostgreSQL: 9.5
 * Redis: 3.2

## 3. 利用方法

### 3.1. ローカルPCにDockerコンテナと共有するディレクトリを作成

```bash:
mkdir ~/development
mkdir ~/development/workspace
```

 * data-volume/workspaceディレクトリ  
  Dockerコンテナの/develop/workspaceディレクトリにマウントされます。
  Webアプリケーションのプロジェクトが配置されます。

### 3.2. Dockerコンテナの取得と起動

 OS X
```bash:
docker run -d \
 -v ~/development:/develop:rw \
 -p 80:80 -p 443:443 -p 3306:3306 \
 -t -i \
 -h taiga-server-01 \
 --name taiga-server-01 \
 accon/taiga:1.00
```

Windows
```bash:
docker run -d `
 -v F:/docker/taiga:/develop/workspace:rw `
 -p 80:80 -p 443:443 -p 3306:3306 `
 -t -i `
 -h taiga-server-01 `
 --name taiga-server-01 `
 accon/taiga:1.00
```

#### 3.3. 動作確認

下のURLにアクセスしPHPの情報が表示されればOK。

* [http://127.0.0.1](http://127.0.0.1)
* [https://127.0.0.1](https://127.0.0.1)

#### 3.4. MySQLの接続

```bash:
mysql -uDevelop -pTemporary_Password --host 127.0.0.1 --port 3306 development
```

* データベース: development
* ユーザ: Develop
* パスワード: Temporary_Password

## 4. よく使うDockerコンテナを制御するコマンド

* コンテナのコンソールに接続

```bash:
docker exec -it taiga-server-01 bash
```

* コンテナのスタート

```bash:
docker start taiga-server-01
```

* コンテナのストップ

```bash:
docker stop taiga-server-01
```

* コンテナの削除

```bash:
docker rm taiga-server-01
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

## X. コンテナ開発者向け

### X.1. Dockerコンテナイメージの管理

#### X.1.1. ビルド

Windows
```bash:
cd  /git/accon/docker/taiga
docker build -t accon/taiga:1.00 .
```

OS X
```bash:
cd ~/Develop/master/accon/v2.0/data-volume/workspace/accon/docker/taiga
docker build -t accon/taiga:1.00 .
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
