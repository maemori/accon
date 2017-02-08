<?php
/**
 * Part of the kurobuta.jp.
 *
 * Copyright (c) 2015 Maemori Fumihiro
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 *
 * @version    1.0
 * @author     Maemori Fumihiro
 * @link       https://kurobuta.jp
 */

// Logger
use \Monolog\Handler\ChromePHPHandler;
use \Monolog\Handler\FirePHPHandler;

/**
 * Log core class facade for the Monolog composer package.
 *
 * This class will provide the interface between the Fuel v1.x class API
 * and the Monolog package, in preparation for FuelPHP v2.0
 */
class Log extends \Fuel\Core\Log
{
	// Logger
	protected static $handler_chrome_php = null;
	protected static $handler_firefox_php = null;
	// DateTimeZone
	protected static $timezone;

	/**
	 * Initialize the class
	 */
	public static function _init()
	{
		parent::_init();
		// ブラウザのコンソールログ
		if (\Config::get('accon.browser_console')) {
			// Chrome
			static::$handler_chrome_php = new \Monolog\Logger('Accon');
			$stream_c = new ChromePHPHandler();
			static::$handler_chrome_php->pushHandler($stream_c);
			// Firefox
			static::$handler_firefox_php = new \Monolog\Logger('Accon');
			$stream_f = new FirePHPHandler();
			static::$handler_firefox_php->pushHandler($stream_f);
		}
	}

	/**
	 * Logs a message with the Info Log Level
	 *
	 * @param   string  $msg     The log message
	 * @param   string  $method  The method that logged
	 * @return  bool    If it was successfully logged
	 */
	public static function info($msg, $method = null)
	{
		$console_msg = self::message('INFO', $msg, $method);
		if (\Config::get('accon.browser_console')) static::$handler_chrome_php->addInfo($console_msg);
		if (\Config::get('accon.browser_console')) static::$handler_firefox_php->addInfo($console_msg);
		return parent::info('GLOBAL IP:'.\Input::real_ip().'(REAL IP:'.\Input::ip().') : '.$msg, $method);
	}

	/**
	 * Logs a message with the Debug Log Level
	 *
	 * @param   string  $msg     The log message
	 * @param   string  $method  The method that logged
	 * @return  bool    If it was successfully logged
	 */
	public static function debug($msg, $method = null)
	{
		$console_msg = self::message('DEBUG', $msg, $method);
		if (\Config::get('accon.browser_console')) static::$handler_chrome_php->addDebug($console_msg);
		if (\Config::get('accon.browser_console')) static::$handler_firefox_php->addDebug($console_msg);
		return parent::debug('GLOBAL IP:'.\Input::real_ip().'(REAL IP:'.\Input::ip().') : '.$msg, $method);
	}

	/**
	 * Logs a message with the Warning Log Level
	 *
	 * @param   string  $msg     The log message
	 * @param   string  $method  The method that logged
	 * @return  bool    If it was successfully logged
	 */
	public static function warning($msg, $method = null)
	{
		$console_msg = self::message('WARNING', $msg, $method);
		if (\Config::get('accon.browser_console')) static::$handler_chrome_php->addWarning($console_msg);
		if (\Config::get('accon.browser_console')) static::$handler_firefox_php->addWarning($console_msg);
		return parent::warning('GLOBAL IP:'.\Input::real_ip().'(REAL IP:'.\Input::ip().') : '.$msg, $method);
	}

	/**
	 * Logs a message with the Error Log Level
	 *
	 * @param   string  $msg     The log message
	 * @param   string  $method  The method that logged
	 * @return  bool    If it was successfully logged
	 */
	public static function error($msg, $method = null)
	{
		$console_msg = self::message('ERROR', $msg, $method);
		if (\Config::get('accon.browser_console')) static::$handler_chrome_php->addError($console_msg);
		if (\Config::get('accon.browser_console')) static::$handler_firefox_php->addError($console_msg);
		return parent::error('GLOBAL IP:'.\Input::real_ip().'(REAL IP:'.\Input::ip().') : '.$msg, $method);
	}

	/**
	 * Logs a message with the Info Log Level
	 *
	 * @param   string  $msg     The log message
	 * @param   string  $method  The method that logged
	 * @return  bool    If it was successfully logged
	 */
	public static function operation($msg, $method = null)
	{
		// 操作ログ
		if (\Config::get('accon.operation_log')) {
			$console_msg = self::message('OPERATION', $msg, $method);
			if (\Config::get('accon.browser_console')) static::$handler_chrome_php->addInfo($console_msg);
			if (\Config::get('accon.browser_console')) static::$handler_firefox_php->addInfo($console_msg);
			return static::write(Fuel::L_INFO, 'OPERATION - '.'GLOBAL IP:'.\Input::real_ip().'(REAL IP:'.\Input::ip().') : '.$msg, $method);
		}
	}

	/**
	 * message
	 *
	 * @param string $log_level
	 * @param string $msg
	 * @return string
	 */
	private static function message($log_level = '', $msg = '', $method = null)
	{
		$date = new DateTime();
		$time = microtime();
		$time_list = explode(' ',$time);
		$time_micro = explode('.',$time_list[0]);
		$date_str = $date->format('Y-m-d H:i:s.').substr($time_micro[1],0,3);
		$msg = $log_level.' '.$date_str.(empty($method) ? '' : ' - '.$method.' - ').' --> '.$msg;
		return $msg;
	}

}
