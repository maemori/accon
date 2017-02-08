<?php
// Bootstrap the framework DO NOT edit this
require COREPATH.'bootstrap.php';

\Autoloader::add_classes(array(
	// Add classes you want to override here
	// Example: 'View' => APPPATH.'classes/view.php',
));

// Register the autoloader
\Autoloader::register();

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGING
 * Fuel::PRODUCTION
 */
\Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : \Fuel::DEVELOPMENT);

// Initialize the framework with the config file.
\Fuel::init('config.php');

// Boot the app
require APPPATH.'modules/accon/bootstrap.php';
require APPPATH.'modules/menus/bootstrap.php';
require APPPATH.'modules/treebooks/bootstrap.php';
require APPPATH.'modules/download/bootstrap.php';