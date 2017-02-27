create database service_db;
grant all on service_db.* to service_admin@localhost identified by 'ServiceAdmin@P2W0rd';
grant all privileges on service_db.* to service_admin@"172.%.%.%" identified by 'ServiceAdmin@P2W0rd' with grant option;