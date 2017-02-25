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

# インストール

## 基本モジュール
RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install -y build-essential
RUN apt-get install -y apt-utils
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y git
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y ntp
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y openssl openssh-server libssl-dev
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y unzip
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y vim curl wget build-essential
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y language-pack-ja-base language-pack-ja ibus-mozc

## 日本語環境設定
RUN update-locale LANG=ja_JP.UTF-8 LANGUAGE=ja_JP:ja

### 環境変数設定
ENV LANG ja_JP.UTF-8
ENV LC_ALL ja_JP.UTF-8
ENV LC_CTYPE ja_JP.UTF-8

## MySQL
RUN apt-get install -y -o Dpkg::Options::="--force-confold" mysql-common
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -q -y mysql-server
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y mysql-client

## PHP
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y php php-cli php-pear php-fpm php-mysql php-curl php-gd php-mcrypt php-intl php-imap php-tidy php-imagick php-mcrypt php-xdebug php-redis php-mbstring

## Nginx
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y nginx

## Redis
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y redis-server

# グループ・ユーザ
RUN groupadd -g 1000 develop
RUN useradd -u 1000 -g 1000 -m -d /home/develop -s /bin/bash -c '共通開発者アカウント' develop
RUN echo 'develop:develop' | chpasswd
RUN gpasswd -a develop adm
RUN gpasswd -a develop sudo
RUN gpasswd -a develop mysql
RUN gpasswd -a develop www-data
RUN gpasswd -a develop staff
RUN gpasswd -a www-data develop
RUN gpasswd -a www-data staff

# ディレクトリ
RUN mkdir /develop
RUN mkdir /develop/www
RUN mkdir /develop/workspace
RUN chown -R develop:develop /develop

# 設定
## PHP
RUN sed -i "s/;date.timezone =.*/date.timezone = Asia\/Tokyo/" /etc/php/7.0/fpm/php.ini
RUN sed -i "s/max_execution_time = .*/max_execution_time = 180/" /etc/php/7.0/cli/php.ini


### xDebug
ADD ./conf/xdebug.ini /etc/php/7.0/mods-available/xdebug.ini

### FPM
ADD conf/www.conf /etc/php/7.0/fpm/pool.d/www.conf
RUN sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php/7.0/fpm/php-fpm.conf
RUN sed -i "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/" /etc/php/7.0/fpm/php.ini
RUN sed -i "s/session.save_handler = files/session.save_handler = redis/" /etc/php/7.0/fpm/php.ini

## Nginx
ADD ./conf/nginx.conf /etc/nginx/nginx.conf
ADD ./conf/default /etc/nginx/sites-available/default
ADD ./conf/default-ssl /etc/nginx/sites-available/default-ssl
ADD ./conf/fastcgi.conf /etc/nginx/fastcgi.conf
RUN ln -s /etc/nginx/sites-available/default-ssl /etc/nginx/sites-enabled/

## MySQL
RUN mkdir /home/mysql
RUN chown mysql /home/mysql/
RUN usermod -d /home/mysql/ mysql

## Ntp
RUN cp -p /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

## サーバー証明書
RUN mkdir -p /etc/nginx/certs
RUN openssl genrsa -out /etc/nginx/certs/server.key 4096
RUN openssl req -new -batch -key /etc/nginx/certs/server.key -out /etc/nginx/certs/server.csr
RUN openssl x509 -req -days 3650 -in /etc/nginx/certs/server.csr -signkey /etc/nginx/certs/server.key -out /etc/nginx/certs/server.crt

# 起動用ファイルの設置
ADD ./module/run.sh /etc/service/run
RUN chmod +x /etc/service/run

# データベース作成用スクリプトの設置
ADD ./module/database.sql /tmp/database.sql

# 公開ポート
EXPOSE 80 443 3306

# 起動
CMD ["/etc/service/run"]
