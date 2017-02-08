##
# fuelphp-accon
#
#  用途: FuelPHP 開発・実行基盤
#  構成: image[ubuntu-nginx-phpfpm-redis-mysql] + FuelPHP(1.7.3) + ACCON(1.0)
#
# Part of the ACCON.
#
# Copyright (c) 2015 Maemori Fumihiro
# This software is released under the MIT License.
# http://opensource.org/licenses/mit-license.php
#
# @version    1.03
# @author     Maemori Fumihiro
# @link       https://kurobuta.jp
FROM accon/ubuntu-nginx-phpfpm-redis-mysql:1.03
MAINTAINER Maemori Fumihiro

# インストール
RUN mkdir -p /develop/archive
## FuelPHPの設置
RUN curl -k http://fuelphp.com/files/download/34 > /develop/archive/fuelphp.zip
RUN unzip /develop/archive/fuelphp.zip -d /develop/archive/workspace
RUN mv /develop/archive/workspace/fuelphp-1.7.3 /develop/archive/workspace/project

# 設定
ADD module/fuelphp-accon /etc/service/fuelphp-accon
RUN chmod +x /etc/service/fuelphp-accon
# HTTPはHTTPSへリダイレクト
ADD conf/default /etc/nginx/sites-available/default

# 起動
CMD ["/etc/service/fuelphp-accon"]
