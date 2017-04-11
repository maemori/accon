# Short Description
OpenCV server set

# Full Description

## ● [Dockerfileのコード、こちら(GitHub)](https://github.com/maemori/accon/tree/master/docker/opencv)

## ● [Dockerfile一式は、こちらからダウンロード](https://kurobuta.jp/download/get/20)

-----

## 1. 概要

OpenCVを利用したサービスを提供するためのプラットフォーム。  

## 2. 構成要素

 *

## 3. 利用方法（通常使用）

### 3.1. Dockerコンテナの取得と起動

```bash:
docker run -d -p 80:80 -t -i --privileged -h taiga --name taiga accon/taiga
```

最新のTAIGAコンテナをダウンロードしTAIGAサーバーを起動しインストールが開始されます。

### 3.2. インストール状況の確認

ブラウザで[http://localhost/install.html](http://localhost/install.html)にアクセスするとインストールの状況を確認できます。(5秒間隔で更新されます)  
「PROGRESS_[INSTALLATION_COMPLETE]」と表示されればインストールは完了です。

## 4. 利用方法（開発・カスタマイズ）

### 4.1. ローカルPCにDockerコンテナと共有するディレクトリを作成

data-volumeのマウント

```bash:
mkdir -p ~/productment/opencv/workspace
mkdir ~/productment/opencv/www
```

 * productment/opencv/workspaceディレクトリ  
  Dockerコンテナの/develop/workspaceディレクトリにマウントされます。

 * productment/opencv/wwwディレクトリ  
  Dockerコンテナの/develop/wwwディレクトリにマウントされます。


### 4.2. Dockerコンテナの取得と起動

```bash:
docker run -d \
  -v ~/productment/opencv/workspace:/develop/workspace:rw \
  -v ~/productment/opencv/www:/develop/www:rw \
  -p 80:80 -p 443:443 -p 3306:3306 -p 15672:15672 \
  -t -i \
  --privileged \
  -e DISPLAY=$DISPLAY \
  -v /tmp/.X11-unix:/tmp/.X11-unix \
  -h opencv \
  --name opencv \
  accon/opencv:1.00
```

#### 3.3. 動作確認

* http - [http://localhost](http://localhost)
* RabbitMQ - [http://localhost:15672/](http://localhost:15672/)

#### 3.4. MySQLの接続

 * Host: 127.0.0.1
 * Port: 3306
 * Datavese: development
 * User: Develop
 * Passwoord: Temporary_Password

## 4. よく使うDockerコンテナを制御するコマンド

* コンテナのコンソールに接続

```bash:
docker exec -it opencv bash
```

* コンテナのスタート

```bash:
docker start opencv
```

* コンテナのストップ

```bash:
docker stop opencv
```

* コンテナの削除

```bash:
docker rm opencv
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

OS X
```bash:
docker rmi accon/opencv:1.00
docker rmi accon/opencv:latest
docker images
cd ~/Develop/master/accon/v2.0/data-volume/workspace/accon/docker/opencv
docker build -t accon/opencv:1.00 .
```

#### X.1.2. レポジトリにプッシュ

```bash:
# push
docker push accon/opencv:1.00
# Tag
docker tag accon/opencv:1.00 accon/opencv:latest
docker push accon/opencv:latest
# None images delete
docker images | awk '/<none/{print $3}' | xargs docker rmi
docker images
```

#### X.1.3. コンテナイメージの削除

```
docker rmi accon/opencv:latest
docker rmi accon/opencv:1.00
```
