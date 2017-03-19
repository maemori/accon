##
# ubuntu-nginx-python3-postgresql
#
#  用途: 開発環境の基礎構成
#  構成: Ubuntu + Nginx(ssl) + Python3 + Circus + PostgreSQL
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
  apt-get update && \
  DEBIAN_FRONTEND="noninteractive" apt-get install -y \
    openssl openssh-server libssl-dev \
    nginx \
    redis-server \
    rabbitmq-server \
    postgresql-9.5 postgresql-contrib-9.5 \
    postgresql-doc-9.5 postgresql-server-dev-9.5 \
    postfix && \
    rm -rf /var/lib/apt/lists/*

## Python3
RUN \
  apt-get update && apt-get install -y python3 python3-pip python3-dev && \
  pip3 install --upgrade pip && \
  pip3 install virtualenv virtualenvwrapper circus

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
  gpasswd -a develop postgres && \
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

## PostgreSQL
RUN \
  echo "host all all 0.0.0.0/0 md5" >> /etc/postgresql/9.5/main/pg_hba.conf && \
  echo "listen_addresses = '*'" >> /etc/postgresql/9.5/main/postgresql.conf

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

# Installation of startup file
ADD ./module/run.sh /etc/service/run
RUN chmod +x /etc/service/run

# Cleanup
RUN apt-get -y autoremove && apt-get -y autoclean

# Pubkic ports
EXPOSE 80 443 5432

# Startup
CMD ["/etc/service/run"]
