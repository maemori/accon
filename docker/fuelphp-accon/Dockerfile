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
# @version    1.10
# @author     Maemori Fumihiro
# @link       https://kurobuta.jp
FROM accon/ubuntu-nginx-phpfpm-redis-mysql:1.10
MAINTAINER Maemori Fumihiro

# インストール
RUN mkdir -p /develop/archive
## FuelPHPの設置
RUN curl -k https://fuelphp.com/files/download/36 -o /develop/archive/fuelphp.zip
RUN unzip /develop/archive/fuelphp.zip -d /develop/archive/workspace
RUN mv /develop/archive/workspace/fuelphp-* /develop/archive/workspace/product

## 起動用ファイルの設置
ADD ./module/fuelphp-accon.sh /etc/service/fuelphp-accon
RUN chmod +x /etc/service/fuelphp-accon
ADD ./module/run.sh /etc/service/run
RUN chmod +x /etc/service/run

# 起動
CMD ["/etc/service/fuelphp-accon"]
