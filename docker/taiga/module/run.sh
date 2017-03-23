#!/usr/bin/env bash
/etc/service/progress start
service postgresql start
service nginx start
service postfix start

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

# Service start
service rabbitmq-server start
/etc/service/progress progress "[SERVICE:START]_rabbitmq-server"
service redis-server start
/etc/service/progress progress "[SERVICE:START]_redis-server"
service circusd start
/etc/service/progress progress "[SERVICE:START]_circusd"
sleep 3
circusctl start taiga
/etc/service/progress progress "[SERVICE:START]_taiga"
sleep 3
circusctl start taiga-celery
/etc/service/progress progress "[SERVICE:START]_taiga-celery"
sleep 3
nohup coffee /develop/workspace/taiga-events/index.coffee > /dev/null 2>&1 &
/etc/service/progress progress "[SERVICE:START]_coffee"
sleep 3
circusctl start taiga-events
/etc/service/progress progress "[SERVICE:START]_taiga-events"
service nginx restart
/etc/service/progress progress "[SERVICE:RESTART]_nginx"

/etc/service/progress end

tail -f /dev/null
