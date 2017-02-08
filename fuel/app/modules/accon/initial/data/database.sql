create database accon;
grant all on accon.* to admin@localhost identified by 'password';
grant all privileges on accon.* to admin@"192.168.%.%" identified by 'password' with grant option;
