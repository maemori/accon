##
#  OpenCV
#
#  用途: プロジェクト管理プラットフォーム
#  構成: image[ubuntu-nginx-python3-ruby-nodejs-redis-postgresql] + TAIGA
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
FROM accon/ubuntu-nginx-python3-circus-mysql:1.00
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
RUN \
  mkdir /develop/src/opencv/build && \
  cd /develop/src/opencv/build && \
  cmake \
   -DOPENCV_EXTRA_MODULES_PATH=/develop/src/opencv_contrib/modules \
   -DCMAKE_INSTALL_PREFIX=/usr/local \
   -DBUILD_SHARED_LIBS=OFF \
   -DCMAKE_BUILD_TYPE=Release \
   -DCMAKE_C_FLAGS_RELEASE= \
   -DCMAKE_CXX_FLAGS_RELEASE= \
   -DCMAKE_FIND_FRAMEWORK=LAST \
   -DCMAKE_VERBOSE_MAKEFILE=ON \
   -Wno-dev \
   -DBUILD_JASPER=OFF \
   -DBUILD_JPEG=ON \
   -DBUILD_TIFF=ON \
   -DBUILD_OPENEXR=OFF \
   -DBUILD_PNG=ON \
   -DBUILD_ZLIB=OFF \
   -DBUILD_opencv_java=OFF \
   -DBUILD_TESTS=OFF \
   -DBUILD_PERF_TESTS=OFF \
   -DWITH_1394=OFF \
   -DWITH_EIGEN=ON \
   -DWITH_FFMPEG=OFF \
   -DWITH_GPHOTO2=OFF \
   -DWITH_GSTREAMER=OFF \
   -DWITH_JASPER=OFF \
   -DWITH_OPENEXR=ON \
   -DWITH_OPENGL=ON \
   -DWITH_QUICKTIME=OFF \
   -DWITH_QT=OFF \
   -DWITH_TBB=OFF \
   -DWITH_VTK=OFF \
   -DWITH_CUDA=OFF \
   -DWITH_OPENCL=OFF \
   -DBUILD_opencv_python2=OFF \
   -DBUILD_opencv_python3=ON \
   -DPYTHON_EXECUTABLE=$(which python3.5) \
   -DPYTHON_INCLUDE_DIR=$(python3.5 -c "from distutils.sysconfig import get_python_inc; print(get_python_inc())") \
   -DPYTHON_PACKAGES_PATH=$(python3.5 -c "from distutils.sysconfig import get_python_lib; print(get_python_lib())") \
   -DENABLE_SSSE3=ON \
   -DENABLE_SSE41=ON \
   -DENABLE_SSE42=ON \
   -DENABLE_AVX=ON \
   .. && \
   make -j4 && make install && ldconfig

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
