##
#  OpenCV
#
#  用途: プロジェクト管理プラットフォーム
#  構成: image[ubuntu-nginx-python3-jupyter-django-mysql] + OpenCV
#
# Part of the ACCON.
#
# Copyright (c) 2017 Maemori Fumihiro
# This software is released under the MIT License.
# http://opensource.org/licenses/mit-license.php
#
# @version    1.00
# @author     Maemori Fumihiro
# @link       https://kurobuta.jp
FROM accon/ubuntu-nginx-python3-jupyter-django-mysql:1.00
MAINTAINER Maemori Fumihiro

# OpenCV
RUN \
  git clone https://github.com/opencv/opencv.git /develop/src/opencv && \
  cd /develop/src/opencv && \
  git checkout -b 3.2.0 refs/tags/3.2.0

# OpenCV's extra modules
RUN \
  git clone https://github.com/opencv/opencv_contrib.git /develop/src/opencv_contrib && \
  cd /develop/src/opencv_contrib && \
  git checkout -b 3.2.0 refs/tags/3.2.0

# OpenCV make & install
ADD ./module/opencv_make.sh /develop/src/opencv_make
RUN chmod +x /develop/src/opencv_make
RUN /develop/src/opencv_make

# Nginx conf
ADD ./conf/default /etc/nginx/sites-available/

# Startup file
ADD ./module/progress.sh /etc/service/progress
RUN chmod +x /etc/service/progress
ADD ./module/run.sh /etc/service/run
RUN chmod +x /etc/service/run

# Public port
EXPOSE 80 443 3306 15672

# Startup
CMD ["/etc/service/run"]
