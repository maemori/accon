#!/usr/bin/env bash
/etc/service/progress start

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
    # Python virtual env
    VIRTUALENVWRAPPER_PYTHON=/usr/bin/python3
    WORKON_HOME=/develop/workspace/.virtualenvs
    source /usr/local/bin/virtualenvwrapper.sh
    # mkdir
    mkdir /develop/workspace/media
    mkdir /develop/workspace/static
    mkdir /develop/workspace/logs
    # TAIGA file placement
    cp -ra /develop/archive/taiga-back /develop/workspace/
    chown -R taiga:develop /develop/workspace/
    /etc/service/progress progress "[RUN2:DONE]_TAIGA_back_file_placement"
    chown -R root:develop /usr/local/lib/python3.5/dist-packages
    chmod -R g+w /usr/local/lib/python3.5/dist-packages
    chown -R root:develop /develop/workspace/.virtualenvs
    chmod -R g+w /develop/workspace/.virtualenvs
    # TAIGA setting
    su - taiga -c /etc/service/taiga_setting
  fi
}

service postgresql start
install
service circusd start
circusctl start taiga
service nginx start

/etc/service/progress end

tail -f /dev/null
