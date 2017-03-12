##
# ubuntu-nginx-phpfpm-redis-mysql
#
#  用途: 開発環境の基礎構成
#  構成: Ubuntu + Nginx(ssl) + PHP-FPM(Xdebug) + Redis + mysql
#
# Part of the ACCON.
#
# Copyright (c) 2015-2017 Maemori Fumihiro
# This software is released under the MIT License.
# http://opensource.org/licenses/mit-license.php
#
# @version    1.10
# @author     Maemori Fumihiro
# @link       https://kurobuta.jp

FROM ubuntu:16.10
MAINTAINER Maemori Fumihiro

# 環境変数設定
ENV LANG ja_JP.UTF-8
ENV LC_ALL ja_JP.UTF-8
ENV LC_CTYPE ja_JP.UTF-8

# インストール
RUN \
  apt-get update && \
  apt-get upgrade -y && \
  DEBIAN_FRONTEND="noninteractive" apt-get install -y \
    build-essential git ntp \
    openssl openssh-server libssl-dev \
    unzip vim curl wget build-essential \
    language-pack-ja-base language-pack-ja ibus-mozc \
    php php-cli php-pear php-fpm php-mysql php-curl php-gd php-mcrypt \
    php-intl php-imap php-tidy php-imagick php-mcrypt php-xdebug php-redis \
    php-mbstring \
    nginx \
    redis-server && \
  apt-get install -y -o Dpkg::Options::="--force-confold" mysql-common && \
  DEBIAN_FRONTEND="noninteractive" apt-get install -q -y mysql-server mysql-client

# 日本語環境設定
RUN update-locale LANG=ja_JP.UTF-8 LANGUAGE=ja_JP:ja

# グループ・ユーザ
RUN \
  groupadd -g 1000 develop && \
  useradd -u 1000 -g 1000 -m -d /home/develop -s /bin/bash -c '共通開発者アカウント' develop && \
  echo 'develop:develop' | chpasswd && \
  gpasswd -a develop adm && \
  gpasswd -a develop sudo && \
  gpasswd -a develop mysql && \
  gpasswd -a develop www-data && \
  gpasswd -a develop staff && \
  gpasswd -a www-data develop && \
  gpasswd -a www-data staff

# ディレクトリ
RUN \
  mkdir /develop && \
  mkdir /develop/www && \
  mkdir /develop/workspace && \
  chown -R develop:develop /develop

# 設定
## PHP
RUN \
  sed -i "s/;date.timezone =.*/date.timezone = Asia\/Tokyo/" /etc/php/7.0/fpm/php.ini && \
  sed -i "s/max_execution_time = .*/max_execution_time = 180/" /etc/php/7.0/cli/php.ini

### xDebug
ADD ./conf/xdebug.ini /etc/php/7.0/mods-available/xdebug.ini

### FPM
ADD conf/www.conf /etc/php/7.0/fpm/pool.d/www.conf
RUN \
  sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php/7.0/fpm/php-fpm.conf && \
  sed -i "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/" /etc/php/7.0/fpm/php.ini && \
  sed -i "s/session.save_handler = files/session.save_handler = redis/" /etc/php/7.0/fpm/php.ini

## Nginx
ADD ./conf/nginx.conf /etc/nginx/nginx.conf
ADD ./conf/default /etc/nginx/sites-available/default
ADD ./conf/default-ssl /etc/nginx/sites-available/default-ssl
ADD ./conf/fastcgi.conf /etc/nginx/fastcgi.conf
RUN ln -s /etc/nginx/sites-available/default-ssl /etc/nginx/sites-enabled/

## MySQL
RUN \
  sed -i -e "s/^bind-address\s*=\s*\(.*\)/bind-address = 0.0.0.0/g" /etc/mysql/mysql.conf.d/mysqld.cnf && \
  mkdir /home/mysql && \
  chown mysql /home/mysql/ && \
  usermod -d /home/mysql/ mysql

## Ntp
RUN cp -p /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

## サーバー証明書
RUN \
  mkdir -p /etc/nginx/certs && \
  openssl genrsa -out /etc/nginx/certs/server.key 4096 && \
  openssl req -new -batch -key /etc/nginx/certs/server.key -out /etc/nginx/certs/server.csr && \
  openssl x509 -req -days 3650 -in /etc/nginx/certs/server.csr -signkey /etc/nginx/certs/server.key -out /etc/nginx/certs/server.crt

# 起動用ファイルの設置
ADD ./module/run.sh /etc/service/run
RUN chmod +x /etc/service/run

# データベース作成用スクリプトの設置
ADD ./module/database.sql /tmp/database.sql

# 公開ポート
EXPOSE 80 443 3306

# 起動
CMD ["/etc/service/run"]
