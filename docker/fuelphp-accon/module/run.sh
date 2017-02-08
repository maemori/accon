#!/usr/bin/env bash
echo  " * Starting MySQL database create"
mysql -uroot < /develop/data/database.sql
echo  " * Starting MySQL data import"
mysql -uroot < /develop/data/tables.sql
echo  " * Service activation completion"
echo [Ctrl]+p+q OR [Ctrl]+c OK!
tail -f /dev/null
