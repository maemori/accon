##
# ubuntu-nginx-python3-mysql
#
#  用途: 開発環境の基礎構成
#  構成: Ubuntu + Nginx(ssl) + Python3 + Node + Circus + RabbitMQ + MySQL
#
# Part of the ACCON.
#
# Copyright (c) 2017 Maemori Fumihiro
# This software is released under the MIT License.
# http://opensource.org/licenses/mit-license.php
#
# @version    1.00
# @author     Maemori Fumihiro
# @link       https://kurobuta.jp
FROM ubuntu:16.10
MAINTAINER Maemori Fumihiro

# 環境変数設定
ENV LANG ja_JP.UTF-8
ENV LC_ALL ja_JP.UTF-8
ENV LC_CTYPE ja_JP.UTF-8

# Install
## Basis
RUN \
  apt-get update && apt-get install -y \
    build-essential git ntp sudo unzip vim \
    autoconf automake bison flex tmux \
    curl wget netcat daemon cmake\
    gettext language-pack-ja-base language-pack-ja

## Library
RUN \
  apt-get update && apt-get install -y \
    libffi-dev libfreetype6-dev libgdbm-dev libncurses5-dev libjpeg-dev libtool \
    libpq-dev libzmq3-dev libxml2-dev libxslt-dev zlib1g-dev

## Server
RUN \
  apt-get update && DEBIAN_FRONTEND="noninteractive" apt-get install -y \
    openssl openssh-server libssl-dev \
    nginx \
    redis-server \
    rabbitmq-server \
    postfix && \
  apt-get install -y -o Dpkg::Options::="--force-confold" mysql-common && \
    DEBIAN_FRONTEND="noninteractive" apt-get install -q -y mysql-server mysql-client  && \
  rm -rf /var/lib/apt/lists/*

## Python3
RUN \
  apt-get update && apt-get install -y python3 python3-pip python3-dev && \
    pip3 install --upgrade pip && \
    pip3 install virtualenv virtualenvwrapper circus

## Nodejs & coffee-script
RUN \
  apt-get update && apt-get install -y nodejs npm && \
    npm cache clean && \
    npm install n -g && \
    n stable && \
    n 7 && \
    ln -s /usr/bin/nodejs /usr/bin/node && \
    npm install -g gulp && \
    npm install -g coffee-script

# Language settings
RUN \
  update-locale LANG=ja_JP.UTF-8 LANGUAGE=ja_JP:ja && \
  echo "ja_JP.UTF-8 UTF-8" >> /etc/locale.gen && locale-gen

# Group and user
RUN \
  groupadd -g 1000 develop && \
  useradd -u 1000 -g 1000 -m -d /home/develop -s /bin/bash -c 'Common Developer Account' develop && \
  echo 'develop:develop' | chpasswd && \
  gpasswd -a develop sudo && \
  gpasswd -a develop mysql && \
  gpasswd -a develop rabbitmq && \
  gpasswd -a develop www-data && \
  gpasswd -a www-data develop

# Mount directory
RUN \
  mkdir /develop && \
  mkdir /develop/www && \
  mkdir /develop/workspace && \
  chown -R develop:develop /develop

# Settings
## RabbitMQ (wget http://localhost:15672)
RUN \
  service rabbitmq-server start && \
  rabbitmq-plugins enable rabbitmq_management && \
  cd /tmp && \
  wget http://localhost:15672/cli/rabbitmqadmin && \
  chmod 755 rabbitmqadmin && \
  mv rabbitmqadmin /usr/sbin/

## Nginx
ADD ./conf/nginx.conf /etc/nginx/nginx.conf
ADD ./conf/default /etc/nginx/sites-available/default
ADD ./conf/default-ssl /etc/nginx/sites-available/default-ssl
ADD ./conf/fastcgi.conf /etc/nginx/fastcgi.conf
RUN ln -s /etc/nginx/sites-available/default-ssl /etc/nginx/sites-enabled/

## Server certificate
RUN \
  mkdir -p /etc/nginx/certs && \
  openssl genrsa -out /etc/nginx/certs/server.key 4096 && \
  openssl req -new -batch -key /etc/nginx/certs/server.key -out /etc/nginx/certs/server.csr && \
  openssl x509 -req -days 3650 -in /etc/nginx/certs/server.csr -signkey /etc/nginx/certs/server.key -out /etc/nginx/certs/server.crt

## MySQL
RUN \
  sed -i -e "s/^bind-address\s*=\s*\(.*\)/bind-address = 0.0.0.0/g" /etc/mysql/mysql.conf.d/mysqld.cnf && \
  mkdir /home/mysql && \
  chown mysql /home/mysql/ && \
  usermod -d /home/mysql/ mysql

## circus
ADD ./module/circusd.sh /etc/init.d/circusd
ADD ./conf/circus.ini /etc/circus/circus.ini
RUN \
  chmod +x /etc/init.d/circusd && \
  mkdir /var/log/circus

## Python3
RUN \
  echo "### Virtualenvwrapper\nif [ -f /usr/local/bin/virtualenvwrapper.sh ]; then\n  export VIRTUALENVWRAPPER_PYTHON=/usr/bin/python3\n  WORKON_HOME=$HOME/.virtualenvs\n  source /usr/local/bin/virtualenvwrapper.sh\nfi" >> /root/.bashrc && \
  echo "### Virtualenvwrapper\nif [ -f /usr/local/bin/virtualenvwrapper.sh ]; then\n  export VIRTUALENVWRAPPER_PYTHON=/usr/bin/python3\n  export WORKON_HOME=/home/develop/.virtualenvs\n  source /usr/local/bin/virtualenvwrapper.sh\nfi" >> /home/develop/.bashrc

##  RabbitMQ
ADD ./conf/rabbitmq.config /etc/rabbitmq/rabbitmq.config

# Installation of startup file
ADD ./module/run.sh /etc/service/run
RUN chmod +x /etc/service/run

# Database initial script
ADD ./module/database.sql /tmp/database.sql

# Cleanup
RUN apt-get -y autoremove && apt-get -y autoclean

# Pubkic ports
EXPOSE 80 443 15672 3306

# Startup
CMD ["/etc/service/run"]
