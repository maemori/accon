#!/usr/bin/env bash
/etc/service/progress start
service postgresql start
service rabbitmq-server start
service redis-server start
service nginx start
service postfix start

# Creating a taiga user and virtualhost for rabbitmq
rabbitmqctl add_user taiga PASSWORD
rabbitmqctl add_vhost taiga
rabbitmqctl set_permissions -p taiga taiga ".*" ".*" ".*"

# install
install() {
  # taiga-front initialize
  if [ ! -e /develop/www/index.html ]; then
    # TAIGA file placement
    cp -ra /develop/archive/taiga-front-dist/dist/* /develop/www/
    /etc/service/progress progress "[RUN1:DONE]_TAIGA_front_file_placement"
  fi
  # taiga-back initialize
  if [ ! -e /develop/workspace/taiga-back ]; then
    # mkdir
    mkdir /develop/workspace/logs
    # TAIGA file placement
    cp -ra /develop/archive/taiga-back /develop/workspace/
    /etc/service/progress progress "[RUN2:DONE]_TAIGA_back_file_placement"
  fi
  # taiga-events initialize
  if [ ! -e /develop/workspace/taiga-events/config.json ]; then
    # TAIGA file placement
    cp -ra /develop/archive/taiga-events /develop/workspace/
    /etc/service/progress progress "[RUN3:DONE]_TAIGA_events_file_placement"
  fi
  chown -R taiga:develop /develop/workspace/
  chmod -R g+w /develop/workspace/
  chown -R taiga:develop /develop/www/
  chmod -R g+w /develop/www/
  # Python virtual env
  VIRTUALENVWRAPPER_PYTHON=/usr/bin/python3
  WORKON_HOME=/develop/workspace/.virtualenvs
  source /usr/local/bin/virtualenvwrapper.sh
  chown -R root:develop /usr/local/lib/python3.5/dist-packages
  chmod -R g+w /usr/local/lib/python3.5/dist-packages
  chown -R root:develop /develop/workspace/.virtualenvs
  chmod -R g+w /develop/workspace/.virtualenvs
  /etc/service/progress progress "[RUN4:DONE]_Python_virtual_env"
  # TAIGA setting
  su - taiga -c /etc/service/taiga_setting
}

# TAIGA installi
install

# TAIGA start
/etc/service/progress progress "[SERVICE:START]_redis-server"
service circusd start
/etc/service/progress progress "[SERVICE:START]_circusd"
python3 -m circus.circusctl start taiga
/etc/service/progress progress "[SERVICE:START]_taiga"
python3 -m circus.circusctl start taiga-celery
/etc/service/progress progress "[SERVICE:START]_taiga-celery"
nohup coffee /develop/workspace/taiga-events/index.coffee > /dev/null 2>&1 &
/etc/service/progress progress "[SERVICE:START]_coffee"
python3 -m circus.circusctl start taiga-events
/etc/service/progress progress "[SERVICE:START]_taiga-events"

/etc/service/progress end

tail -f /dev/null
