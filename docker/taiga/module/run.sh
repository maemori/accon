#!/usr/bin/env bash
workspace_dir=/develop/workspace
progress_cnt=1

progress() {
  # taiga-front initialize
  if [ -e $workspace_dir"/PROGRESS"* ]; then
    rm -f $workspace_dir"/PROGRESS"*
  fi
  touch $workspace_dir"/PROGRESS["$progress_cnt"of10]"$1
  progress_cnt=`expr $progress_cnt \+ 1 `
}

# Service start
start() {
  service postgresql start
  #service redis-server start
  #service rabbitmq-server start
  service circusd start
  service nginx start
}

# install
install() {
  # taiga-front initialize
  if [ ! -e /develop/www/index.html ]; then
    progress "Front_install"
    # TAIGA file placement
    cp -ra /develop/archive/taiga-front-dist/dist/* /develop/www/
    progress "Front_installation_complete"
  fi

  # taiga-back initialize
  if [ ! -e /develop/workspace/taiga-back ]; then
    progress "Back_install"
    mkdir /develop/workspace/media
    mkdir /develop/workspace/static
    mkdir /develop/workspace/logs
    # TAIGA file placement
    cp -ra /develop/archive/taiga-back /develop/workspace/
    progress "Back_file_placement"
    # Populate the database with initial basic data
    cd /develop/workspace/taiga-back
    su develop -c "python3 manage.py migrate --noinput"
    progress "Data_initial_basic_data"
    su develop -c "python3 manage.py loaddata initial_user"
    progress "Data_initial_user"
    su develop -c "python3 manage.py loaddata initial_project_templates"
    progress "Data_initial_project_templates"
    #python3 manage.py loaddata initial_role
    su develop -c "python3 manage.py compilemessages"
    progress "Data_compilemessages"
    su develop -c "python3 manage.py collectstatic --noinput"
    su develop -c progress "Data_completion_initialization"
  fi
}

install
start

# TEST
#cd /develop/workspace/taiga-back
#python3 manage.py runserver
wget http://localhost:8000/api/v1/

# taiga-events initialize
#if [ ! -e /develop/workspace/taiga-events ]; then
  # TAIGA file placement
#  cp -ra /develop/master/taiga-events /develop/workspace/
#  rabbitmqctl add_user taiga PASSWORD
#  rabbitmqctl add_vhost taiga
#  rabbitmqctl set_permissions -p taiga taiga ".*" ".*" ".*"
#fi

#circusctl reloadconfig
#circusctl restart taiga
#circusctl start taiga-celery

#service circusd restart
#service nginx restart
# Circusd start
#sudo -u develop /usr/local/bin/circusd /develop/workspace/circus.ini &

# Front start
#gulp

# Service start


tail -f /dev/null
