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

# Database tables create
if [ -e /tmp/tables.sql ]; then
	echo  "MySQL tables create"
  mysql -uroot service_db < /tmp/tables.sql
	rm -f /tmp/tables.sql
fi

# Startup complete
echo -e "\nStartup complete"
local_ip_address=$(ip address | grep 'global eth0' | sed -e 's/.*inet[^6][^0-9]*\([0-9.]*\)[^0-9]*.*/\1/')
echo "IP ADDRESS:"$local_ip_address
echo "\n[Ctrl]+c : To the console"
echo "[Ctrl]+p+q : To host OS"

tail -f /dev/null
