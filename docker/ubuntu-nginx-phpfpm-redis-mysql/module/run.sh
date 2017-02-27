#!/usr/bin/env bash

# Service start
service mysql start
service redis-server start
service php7.0-fpm start
service nginx start

# Database create
if [ -e /tmp/database.sql ]; then
  echo  "MySQL database create"
  mysql -uroot < /tmp/database.sql
  rm -f /tmp/database.sql
fi

# Startup complete
echo -e "\nStartup complete"
local_ip_address=$(ip address | grep 'global eth0' | sed -e 's/.*inet[^6][^0-9]*\([0-9.]*\)[^0-9]*.*/\1/')
echo "IP ADDRESS:"$local_ip_address

tail -f /dev/null
