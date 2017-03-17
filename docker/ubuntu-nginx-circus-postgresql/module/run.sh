#!/usr/bin/env bash

# Service start
service postgresql start
service redis-server start
service circusd start
service rabbitmq-server start
service nginx start

tail -f /dev/null
