#!/usr/bin/env bash

service mysql start
service redis-server start
service php7.0-fpm start
service nginx start

echo -e "\nStartup complete"
local_ip_address=$(ip address | grep 'global eth0' | sed -e 's/.*inet[^6][^0-9]*\([0-9.]*\)[^0-9]*.*/\1/')
echo "IP ADDRESS:"$local_ip_address
echo "\n[Ctrl]+c : To the console"
echo "[Ctrl]+p+q : To host OS"
tail -f /dev/null
