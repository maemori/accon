#!/usr/bin/env bash

# Service start
service mysql start
service redis-server start
service circusd start
service rabbitmq-server start
service nginx start
service postfix start

# Database create
if [ -e /tmp/database.sql ]; then
  echo  "MySQL database create"
  mysql -uroot < /tmp/database.sql
  rm -f /tmp/database.sql
fi

tail -f /dev/null
