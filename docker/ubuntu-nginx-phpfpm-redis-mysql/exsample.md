# 【超高速:3分】WindowsにLinuxを立ててWordpressを実行・カスタマイズ・デバック

## ● [Dockerfileは、こちら(GitHub)](https://github.com/maemori/accon/blob/master/docker/ubuntu-nginx-phpfpm-redis-mysql/Dockerfile)

## ● [Dockerfile一式は、こちらからダウンロード](https://kurobuta.jp/download/get/15)

-----

## 1. Dcokerのインストール
https://www.docker.com/products/docker

## 2. Wordpressの取得とファイルの展開
https://ja.wordpress.org/

## 3. 取得したWordpressの圧縮ファイルを展開してホームディレクトリに配置

## 4. Dockerコンテナの取得と起動

### 4.1 Windows用
```bash: Windows
docker run -d `
 -v $home/wordpress:/develop/www:rw `
 -p 80:80 `
 -t -i `
 -h wordpress-server-01 `
 --name wordpress-server-01 `
 accon/ubuntu-nginx-phpfpm-redis-mysql
```

### 4.2 Mac用
```bash: Windows
docker run -d `
 -v $home/wordpress:/develop/www:rw `
 -p 80:80 `
 -t -i `
 -h wordpress-server-01 `
 --name wordpress-server-01 `
 accon/ubuntu-nginx-phpfpm-redis-mysql
```


※ Wordpressの設置後に「docker run」を実行してください

## 5. Wordpressのインストール

### 5.1. 「[http://127.0.0.1](http://127.0.0.1)」にアクセス

### 5.2. 「さあ、始めましょう !」ボタンを押す

### 5.3. 「データベース接続」のための詳細を入力

* データベース名: development
* ユーザー名: Develop
* パスワード: Temporary_Password
* データベースのホスト名: 127.0.0.1
* テーブル接頭辞: wp_

### 5.4. 「インストール実行」ボタンを押す

### 5.5. 「必要情報」の入力

* サイトのタイトル: Wordpressカスタマイズ環境構築のデモ ・・・任意
* ユーザー名: wordpress_admin ・・・任意
* パスワード: Develop_$Temporary^Password ・・・任意
* メールアドレス: develop@example.jp ・・・任意

「Wordpressのインストール」ボタンを押す  
※画面が切り替わらない場合、ブラウザの再読込を行ってください

## 6. 動作確認

### 6.1. 「[管理画面（ダッシュボード）](http://127.0.0.1/wp-admin/)」にアクセス

### 6.2. 「[フロント画面](http://127.0.0.1)」にアクセス

## 7. デバッグ

xDebug用にIPエイリアスを割り当てる

* Macの場合
```
sudo ifconfig lo0 alias 10.254.254.254
```

* Windowsの場合は、ネットワークと共有センターから

-----

## よく使うDコマンド

* コンテナのコンソールに接続
```bash:
docker exec -it wordpress-server-01 bash
```

* コンテナのストップ
```bash:
docker stop wordpress-server-01
```

* コンテナの削除
```bash:
docker rm wordpress-server-01
```

* コンテナの再開
```bash:
docker start wordpress-server-01
```
