#!/usr/bin/env bash
/etc/service/progress start
service postgresql start
service rabbitmq-server start
service redis-server start
service nginx start
service postfix start

# Creating a taiga user and virtualhost for rabbitmq
rabbitmqctl add_user develop PASSWORD
rabbitmqctl add_vhost develop
rabbitmqctl set_permissions -p develop develop ".*" ".*" ".*"

# install
install() {
  # Python virtual env
  VIRTUALENVWRAPPER_PYTHON=/usr/bin/python3
  WORKON_HOME=/develop/workspace/.virtualenvs
  source /usr/local/bin/virtualenvwrapper.sh
  chown -R root:develop /usr/local/lib/python3.5/dist-packages
  chmod -R g+w /usr/local/lib/python3.5/dist-packages
  chown -R root:develop /develop/workspace/.virtualenvs
  chmod -R g+w /develop/workspace/.virtualenvs
  /etc/service/progress progress "[DONE]_Python_virtual_env"
}

#install

/etc/service/progress end

tail -f /dev/null
