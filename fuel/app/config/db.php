<?php
/**
 * The development database settings. These get merged with the global settings.
 */
return array(
    'default' => array(
        'connection'  => array(
            'dsn'        => 'mysql:host=127.0.0.1;dbname=service_db',
            'username'   => 'service_admin',
            'password'   => 'ServiceAdmin@P2W0rd',

        ),
    ),
	'redis' => array(
		'default' => array(
			'hostname' => '127.0.0.1',
			'port' => 6379
		)
	),
);
