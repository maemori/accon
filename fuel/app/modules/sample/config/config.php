<?php
/**
 * Part of the Fuel framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2014 Fuel Development Team
 * @link       http://fuelphp.com
 */


return array(
	/**
	 * Localization & internationalization settings
	 */
	'language'           => 'jp',
	'locale'             => 'ja_JP.UTF-8',

	/**
	 * Internal string encoding charset
	 */
	'encoding'  => 'UTF-8',

	/**
	 * DateTime settings
	 *
	 * server_gmt_offset	in seconds the server offset from gmt timestamp when time() is used
	 * default_timezone		optional, if you want to change the server's default timezone
	 */
	'default_timezone'   => 'Asia/Tokyo',

	/**
	 * Logging Threshold.  Can be set to any of the following:
	 *
	 * Fuel::L_NONE
	 * Fuel::L_ERROR
	 * Fuel::L_WARNING
	 * Fuel::L_DEBUG
	 * Fuel::L_INFO
	 * Fuel::L_ALL
	 */
	'log_threshold'    => Fuel::L_INFO,
	'log_path'         => APPPATH.'logs/',
	'log_date_format'  => 'Y-m-d H:i:s',

	/**
	 * Security settings
	 */
	'security' => array(
		'csrf_autoload'    => false,
		'csrf_token_key'   => 'kurobuta_csrf_token',
		'csrf_expiration'  => 0,

		/**
		 * This input filter can be any normal PHP function as well as 'xss_clean'
		 *
		 * WARNING: Using xss_clean will cause a performance hit.
		 * How much is dependant on how much input data there is.
		 */
		'uri_filter'       => array('htmlentities'),

		/**
		 * This input filter can be any normal PHP function as well as 'xss_clean'
		 *
		 * WARNING: Using xss_clean will cause a performance hit.
		 * How much is dependant on how much input data there is.
		 */
		'input_filter'  => array(),

		/**
		 * This output filter can be any normal PHP function as well as 'xss_clean'
		 *
		 * WARNING: Using xss_clean will cause a performance hit.
		 * How much is dependant on how much input data there is.
		 */
		'output_filter'  => array('Security::htmlentities'),

		/**
		 * With output encoding switched on all objects passed will be converted to strings or
		 * throw exceptions unless they are instances of the classes in this array.
		 */
		'whitelisted_classes' => array(
			'Fuel\\Core\\Presenter',
			'Fuel\\Core\\Response',
			'Fuel\\Core\\View',
			'Fuel\\Core\\ViewModel',
			'Fuel\\Core\\Validation',
			'Closure',
		),
	),

	/**
	 * Cookie settings
	 */
	'cookie' => array(
		// Number of seconds before the cookie expires
		// 'expiration'  => 0,
		// Restrict the path that the cookie is available to
		// 'path'        => '/',
		// Restrict the domain that the cookie is available to
		// 'domain'      => null,
		// Only transmit cookies over secure connections
		'secure'      => true,
		// Only transmit cookies over HTTP, disabling Javascript access
		// 'http_only'   => false,
	),

	/**************************************************************************/
	/* Always Load                                                            */
	/**************************************************************************/
	 'always_load'  => array(
		/**
		 * These packages are loaded on Fuel's startup.
		 * You can specify them in the following manner:
		 *
		 * array('auth'); // This will assume the packages are in PKGPATH
		 *
		 * // Use this format to specify the path to the package explicitly
		 * array(
		 *     array('auth'	=> PKGPATH.'auth/')
		 * );
		 */
		 'packages'  => array(
		 	'orm',
			'auth',
		 ),
	 ),

);
