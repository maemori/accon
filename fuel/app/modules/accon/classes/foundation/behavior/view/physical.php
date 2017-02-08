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

namespace Accon\Foundation;

/**
 * Class Behavior_View_Physical
 *
 * View生成前処理.
 */
class Behavior_View_Physical
{
	/**
	 * 前処理.
	 *
	 * 戻り先のURLを制御
	 */
	public static function before()
	{
		if (\Request::main()->action == ACTION_INDEX or is_null(\Session::get('return_urls'))) {
			\Session::delete('return_urls');
			// 戻り先をセッションに設定
			$return_url = array('key' => 'root', 'url' => \Uri::current());
			\Session::set('return_url', $return_url['url']);
			// 戻り先スタックをセッションに設定
			$return_urls = array($return_url);
			\Session::set('return_urls', $return_urls);
		} else {
			// コントローラ単位で戻り先を制御
			$return_urls = \Session::get('return_urls');
			$last = end($return_urls);
			// 最後に実行されたコントローラと違う場合に戻り先の制御を行う
			if ($last['key'] != \Request::active()->controller) {
				// スタックされた最後のURLと違う場合はスタック
				end($return_urls);
				$prev = prev($return_urls);
				if ($prev['key'] == \Request::active()->controller) {
					// 一つ前のコントローラと現在が同じ場合、画面遷移の戻るを要求したとみなす
					array_pop($return_urls);
				}
				$end = end($return_urls);
				if ($end['key'] != \Request::active()->controller) {
					// 最後のスタックと違う場合のみ追加
					array_push($return_urls, array('key' => \Request::active()->controller, 'url' => \Uri::current()));
				}
			} else {
				// 同一コントローラの場合、アクションを上書き
				array_pop($return_urls);
				array_push($return_urls, array('key' => \Request::active()->controller, 'url' => \Uri::current()));
			}
			// スタックされた戻り先の最後の一つ前を戻り先に設定
			end($return_urls);
			$prev = prev($return_urls);
			// 戻り先をセッションに設定
			\Session::set('return_url', $prev['url']);
			// 戻り先スタックをセッションに設定
			\Session::set('return_urls', $return_urls);
		}
	}

}