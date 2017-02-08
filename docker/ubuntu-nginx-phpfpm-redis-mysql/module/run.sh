#!/usr/bin/env bash
service nginx start
service php5-fpm start
service redis-server start
service mysql start
service ssh start
echo  " * Starting MySQL database create"
mysql -uroot < /develop/data/database.sql
echo  " * Starting MySQL data import"
mysql -uroot < /develop/data/tables.sql
echo  " * Service activation completion"
echo [Ctrl]+p+q OR [Ctrl]+c OK!
tail -f /dev/null
