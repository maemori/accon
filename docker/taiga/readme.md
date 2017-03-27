# Short Description
プロジェクト管理プラットフォーム: TAIGA  
主な機能 : エピック・ユーザストーリ・スプリント・タスクボード・かんばん・課題・情報共有(Wiki)の運用。
※ 日本語対応、リアルタイム更新

# Full Description

## ● [Dockerfileのコード、こちら(GitHub)](https://github.com/maemori/accon/tree/master/docker/taiga)

## ● [Dockerfile一式は、こちらからダウンロード](https://kurobuta.jp/download/get/19)

-----

## 1. 概要

Taiga.ioは、オープンソースとして公開されているプロジェクト管理プラットフォーム。  

## 2. TAIGAサービス構成要素

 * taiga-front : フロントエンドサービス。anglejsとcoffeescriptで構築されたフロントエンド関連のコードで構成されています。
 * taiga-back : バックエンドサービス。djangoとpython3を使って構築されたapiで構成されています。
 * taiga-events : フロントエンドをリアルタイム更新するためのサービス。WebSocketサーバーとして動作し、バックログ、タスク・ボード、かんばん、課題をリアルタイムに更新します。
 * taiga-celery : 非同期タスク実行サービス。webhooksやimport/exportなどを非同期で実行します。

## 3. 構成要素

必要なミドルウェアは「[accon/ubuntu-nginx-circus-postgresql](https://github.com/maemori/accon/tree/master/docker/ubuntu-nginx-circus-postgresql)」コンテナを使用しています。  
当コンテナは「[accon/ubuntu-nginx-circus-postgresql](https://github.com/maemori/accon/tree/master/docker/ubuntu-nginx-circus-postgresql)」コンテナの上に構築されています。
詳細な内容は[Docker Hub](https://hub.docker.com/r/accon/ubuntu-nginx-circus-postgresql/)をご参照ください。

## 3. 利用方法（通常使用）

### 3.1. Dockerコンテナの取得と起動

```bash:
docker run -d -p 80:80 -t -i -h taiga --name taiga accon/taiga
```

最新のTAIGAコンテナをダウンロードしTAIGAサーバーを起動しインストールが開始されます。

### 3.2. TAIGAのインストール状況の確認

ブラウザで[http://localhost/install.html](http://localhost/install.html)にアクセスするとインストールの状況を確認できます。(5秒間隔で更新されます)  
「PROGRESS_[INSTALLATION_COMPLETE]」と表示されればインストールは完了です。

### 3.3. TAIGAの利用開始

ブラウザで[http://localhost](http://localhost)にアクセスします。  
adminユーザ（初期パスワードは123123）もしくは新規にユーザを作成してログインを行います。  

#### 日本語化は右上のアカウントメニューの「Edit Profil」を実行しLanguageを「日本語」に変更します。

### 3.3. TAIGAの利用方法

[taiga.io（公式）](https://tree.taiga.io/support/)をご参照ください。

## 4. 利用方法（開発・カスタマイズ）

### 4.1. ローカルPCにDockerコンテナと共有するディレクトリを作成

data-volumeのマウント

```bash:
mkdir -p ~/productment/taiga/workspace
mkdir ~/productment/taiga/www
```

 * productment/taiga/workspaceディレクトリ  
  Dockerコンテナの/develop/workspaceディレクトリにマウントされます。
  TAIGAアプリケーションのバックエンドのプロジェクトが配置されます。

 * productment/taiga/wwwディレクトリ  
  Dockerコンテナの/develop/wwwディレクトリにマウントされます。
  TAIGAのフロントエンドのプロジェクトが配置されます。

### 4.2. Dockerコンテナの取得と起動

```bash:
docker run -d \
  -v ~/productment/taiga/workspace:/develop/workspace:rw \
  -v ~/productment/taiga/www:/develop/www:rw \
  -p 80:80 -p 443:443 -p 5432:5432 -p 15672:15672 \
  -t -i \
  -h taiga\
  --name taiga \
  accon/taiga:1.05
```

#### 3.3. 動作確認

* TAIGA - [http://localhost](http://localhost)
* RabbitMQ - [http://localhost:15672/](http://localhost:15672/)

#### 3.4. PostgerSQLの接続

 * Host: 127.0.0.1
 * Port: 5432
 * Datavese: taiga
 * User: taiga
 * Passwoord: taiga

## 4. よく使うDockerコンテナを制御するコマンド

* コンテナのコンソールに接続

```bash:
docker exec -it taiga bash
```

* コンテナのスタート

```bash:
docker start taiga
```

* コンテナのストップ

```bash:
docker stop taiga
```

* コンテナの削除

```bash:
docker rm taiga
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
docker rmi accon/taiga:1.05
docker rmi accon/taiga:latest
docker images
cd ~/Develop/master/accon/v2.0/data-volume/workspace/accon/docker/taiga
docker build -t accon/taiga:1.05 .
```

#### X.1.2. レポジトリにプッシュ

```bash:
# push
docker push accon/taiga:1.05
# Tag
docker tag accon/taiga:1.05 accon/taiga:latest
docker push accon/taiga:latest
# None images delete
docker images | awk '/<none/{print $3}' | xargs docker rmi
docker images
```

#### X.1.3. コンテナイメージの削除

```
docker rmi accon/taiga:latest
docker rmi accon/taiga:1.00
```
