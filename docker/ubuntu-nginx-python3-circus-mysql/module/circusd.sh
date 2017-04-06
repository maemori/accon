#!/bin/bash

### BEGIN INIT INFO
# Provides:          circusd
# Required-Start:    $local_fs $remote_fs $network $syslog $named sssd
# Required-Stop:     $local_fs $remote_fs $network $syslog $named sssd
# Default-Start:     2 3 4 5
# Default-Stop:      0 1 6
# Short-Description: circus master control daemon
# Description:       This is a daemon that controls the circus minions
### END INIT INFO

# define LSB log_* functions.
. /lib/lsb/init-functions

RETVAL=0
PATH=/sbin:/usr/sbin:/bin:/usr/bin
DESC="circus daemon"
NAME=circusd
DAEMON=/usr/local/bin/circusd
PIDFILE=/var/run/$NAME.pid
CONFIG=/etc/circus/circus.ini
LOGFILE=/var/log/circus/circus.log
BOOTLOG=/var/log/circus/circus.boot
DAEMON_ARGS="--output $LOGFILE --pidfile $PIDFILE $CONFIG"

# Exit if the package is not installed
[ -x "$DAEMON" ] || exit 5

start() {
    echo -n "Starting circusd daemon: "
    daemon --pidfile="$PIDFILE" nohup $DAEMON $DAEMON_ARGS 2> $BOOTLOG
    RETVAL=$?
    echo
    return $RETVAL
}

stop() {
    echo -n "Stopping $DESC ..."
    killproc -p "$PIDFILE" $DAEMON
    RETVAL=$?
    echo
    return $RETVAL
}

rhstatus() {
    status -p "$PIDFILE" -l $NAME $DAEMON
}

restart() {
    stop
    start
}

case "$1" in
    start)
        start
        ;;
    stop)
        stop
        ;;
    restart|force-reload)
        restart
        ;;
    status)
        rhstatus
        ;;
    condrestart|try-restart)
        rhstatus >/dev/null 2>&1 || exit 0
        restart
        ;;
    *)
        echo "Usage: $0 {start|stop|restart|condrestart|try-restart|force-reload|status}"
        exit 3
esac

exit $?
