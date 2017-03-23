#!/usr/bin/env bash

/etc/service/progress progress "[SETTING:START]"

# Python virtual env
export VIRTUALENVWRAPPER_PYTHON=/usr/bin/python3
export WORKON_HOME=/develop/workspace/.virtualenvs
source /usr/local/bin/virtualenvwrapper.sh
mkvirtualenv -p /usr/bin/python3 taiga
workon taiga

# Install python library
pip3 install -r /develop/workspace/taiga-back/requirements.txt >> /develop/workspace/install.log
pip3 install circus >> /develop/workspace/install.log
/etc/service/progress progress "[SETTING:DONE-1_of_8]_Install_python_library"

# Populate the database with initial basic data
cd /develop/workspace/taiga-back/
python3 manage.py migrate --noinput >> /develop/workspace/install.log
/etc/service/progress progress "[SETTING:DONE-2_of_8]_Data_initial_basic_data"
python3 manage.py loaddata initial_user >> /develop/workspace/install.log
/etc/service/progress progress "[SETTING:DONE-3_of_8]_Data_initial_user"
python3 manage.py loaddata initial_project_templates >> /develop/workspace/install.log
/etc/service/progress progress "[SETTING:DONE-4_of_8]_Data_initial_project_templates"
python3 manage.py loaddata initial_role >> /develop/workspace/install.log
/etc/service/progress progress "[SETTING:DONE-5_of_8]_Data_initial_role"
python3 manage.py compilemessages >> /develop/workspace/install.log
/etc/service/progress progress "[SETTING:DONE-6_of_8]_Data_compilemessages"
python3 manage.py collectstatic --noinput >> /develop/workspace/install.log
/etc/service/progress progress "[SETTING:DONE-7_of_8]_Data_completion_initialization"

# Events front module install (Node:Version 7)
cd /develop/workspace/taiga-events/
npm install
/etc/service/progress progress "[SETTING:DONE-8_of_8]_Events_setting"
