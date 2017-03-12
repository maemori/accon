##
# TAIGA
#
#  用途: Scrum開発管理用サーバー
#  構成: image[ubuntu-nginx-phpfpm-redis-mysql] + Python3 + TAIGA
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
FROM accon/ubuntu-nginx-phpfpm-redis-mysql:1.10
MAINTAINER Maemori Fumihiro

# Install dependencies
RUN \
  apt-get update && apt-get install -y \
  sudo build-essential binutils-doc autoconf flex bison libjpeg-dev \
  libfreetype6-dev zlib1g-dev libzmq3-dev libgdbm-dev libncurses5-dev \
  automake libtool libffi-dev curl git tmux gettext netcat \
  python3 python3-pip python3-dev virtualenvwrapper \
  libxml2-dev libxslt-dev
RUN \
  pip3 install --upgrade pip && \
  pip3 install circus gunicorn pytz

# Install RDBMS
RUN \
  apt-get install -y postgresql-9.5 \
  postgresql-contrib-9.5 \
  postgresql-server-dev-9.5

# Create databse
RUN \
  service postgresql start && \
  sudo -u postgres psql -c "CREATE ROLE taiga LOGIN PASSWORD 'Taiga_Database_User_95';" && \
  sudo -u postgres createdb taiga -O taiga && \
  echo 'local all taiga peer' | sudo -u postgres tee -a /etc/postgresql/9.5/main/pg_hba.conf && \
  service postgresql reload

# Install taiga-back
RUN \
  useradd -g 1000 -d /develop/workspace/ taiga && \
  git clone https://github.com/taigaio/taiga-back.git /develop/workspace/taiga-back && \
  mkdir /develop/workspace/media /develop/workspace/static /develop/workspace/logs && \
  cd /develop/workspace/taiga-back && \
  git checkout stable && \
  pip3 install -r requirements.txt && \
  touch /develop/workspace/taiga-back/settings/dockerenv.py && \
  touch /develop/workspace/circus.ini

# Add Taiga Configuration
  ADD ./conf/local.py /develop/workspace/taiga-back/settings/local.py

# Timezone check none
RUN \
  sed -i "s/if offset != 0:/# if offset != 0:/" /usr/local/lib/python3.5/dist-packages/django/db/backends/postgresql/utils.py && \
  sed -i "s/raise AssertionError/# if raise AssertionError/" /usr/local/lib/python3.5/dist-packages/django/db/backends/postgresql/utils.py

# Populate the database with initial basic data
RUN \
  cd /develop/workspace/taiga-back/ && \
  sudo -u taiga python3 manage.py migrate --noinput && \
  sudo -u taiga python3 manage.py loaddata initial_user && \
  sudo -u taiga python3 manage.py loaddata initial_project_templates && \
#  sudo -u taiga python3 manage.py loaddata initial_role && \
  sudo -u taiga python3 manage.py compilemessages && \
  sudo -u taiga python3 manage.py collectstatic --noinput && \
  sudo -u taiga python3 manage.py sample_data && \

# RUN
  sudo -u taiga python3 manage.py runserver
# 起動
CMD ["/etc/service/run"]
