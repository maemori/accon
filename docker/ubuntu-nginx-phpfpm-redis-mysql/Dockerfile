##
# ubuntu-nginx-phpfpm-redis-mysql
#
#  用途: 開発環境の基礎構成
#  構成: Ubuntu + Nginx(ssl) + PHP-FPM(Xdebug) + Redis + mysql
#
# Part of the ACCON.
#
# Copyright (c) 2015 Maemori Fumihiro
# This software is released under the MIT License.
# http://opensource.org/licenses/mit-license.php
#
# @version    1.03
# @author     Maemori Fumihiro
# @link       https://kurobuta.jp

FROM ubuntu:14.04
MAINTAINER Maemori Fumihiro

# インストール
## 基本モジュール
RUN apt-get update
RUN apt-get -y upgrade
RUN apt-get -y install build-essential
RUN apt-get -y install git
RUN apt-get -y install python
RUN apt-get -y install language-pack-ja-base language-pack-ja ibus-mozc
RUN apt-get -y install man
RUN apt-get -y install manpages-ja
RUN apt-get -y install ntp
RUN apt-get -y install openssl openssh-server libssl-dev
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y unzip
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y sysv-rc-conf
## 日本語環境設定
RUN update-locale LANG=ja_JP.UTF-8 LANGUAGE=ja_JP:ja
### 環境変数設定
ENV LANG ja_JP.UTF-8
ENV LC_ALL ja_JP.UTF-8
ENV LC_CTYPE ja_JP.UTF-8
## MySQL
RUN apt-get install -y -o Dpkg::Options::="--force-confold" mysql-common
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -q -y mysql-server
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y --force-yes mysql-client mysql-server
## Php
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y vim curl wget build-essential python-software-properties
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y --force-yes php5 php5-cli php-pear php5-fpm php5-mysql php5-pgsql php5-sqlite php5-curl php5-gd php5-mcrypt php5-intl php5-imap php5-tidy php5-imagick php5-mcrypt php5-xdebug sudo php5-redis
## Nginx
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y nginx
## Redis
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y --force-yes redis-server

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
RUN mkdir /develop
RUN chown -R develop:develop /develop

# 設定
## MySQL
ADD conf/my.cnf /etc/mysql/my.cnf
RUN mysql_install_db
RUN chown -R mysql:mysql /var/lib/mysql
## Php
RUN sed -i "s/;date.timezone =.*/date.timezone = Asia\/Tokyo/" /etc/php5/fpm/php.ini
RUN sed -i "s/;date.timezone =.*/date.timezone = Asia\/Tokyo/" /etc/php5/cli/php.ini
RUN echo \
"" '\n'\
";Redis" '\n'\
"session.save_path = tcp://127.0.0.1:6379" '\n'\
";Xdebug" '\n'\
"xdebug.remote_enable = on" '\n'\
"xdebug.remote_host = localhost" '\n'\
"xdebug.remote_port = 9000" '\n'\
"xdebug.remote_handler = dbgp" '\n'\
"xdebug.remote_connect_back = on" '\n'\
>> /etc/php5/fpm/php.ini
ADD conf/www.conf /etc/php5/fpm/pool.d/www.conf
## Nginx設定
RUN sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php5/fpm/php-fpm.conf
RUN sed -i "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/" /etc/php5/fpm/php.ini
RUN sed -i "s/session.save_handler = files/session.save_handler = redis/" /etc/php5/fpm/php.ini
### Nginxファイルの設置
RUN mkdir /develop/www
RUN mkdir /etc/service
RUN mkdir /etc/service/nginx
RUN mkdir /etc/service/phpfpm
ADD conf/nginx.conf /etc/nginx/nginx.conf
ADD conf/default /etc/nginx/sites-available/default
ADD conf/default-ssl /etc/nginx/sites-available/default-ssl
ADD conf/fastcgi.conf /etc/nginx/fastcgi.conf
ADD module/nginx.sh /etc/service/nginx/run
ADD module/phpfpm.sh /etc/service/phpfpm/run
RUN chmod +x /etc/service/nginx/run
RUN chmod +x /etc/service/phpfpm/run
RUN ln -s /etc/nginx/sites-available/default-ssl /etc/nginx/sites-enabled/
## Ntp
RUN cp -p /usr/share/zoneinfo/Asia/Tokyo /etc/localtime
## サーバー証明書
RUN mkdir -p /etc/nginx/certs
RUN openssl genrsa -out /etc/nginx/certs/server.key 4096
RUN openssl req -new -batch -key /etc/nginx/certs/server.key -out /etc/nginx/certs/server.csr
RUN openssl x509 -req -days 3650 -in /etc/nginx/certs/server.csr -signkey /etc/nginx/certs/server.key -out /etc/nginx/certs/server.crt
## 起動用ファイルの設置
ADD module/run.sh /etc/service/run
RUN chmod +x /etc/service/run

# 起動
CMD ["/etc/service/run"]