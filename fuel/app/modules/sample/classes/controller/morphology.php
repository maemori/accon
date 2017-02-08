<?php
/**
 * Part of the kurobuta.jp.
 *
 * Copyright (c) 2015 kurobuta.jp Development Team
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 *
 * @version    1.0
 * @author     kurobuta.jp Development Team
 * @link       https://kurobuta.jp
 */

namespace Sample;

// 使用モデル
use \Sample\Model\Morphology;

/**
 * 形態素解析コントローラー
 */
class Controller_Morphology extends \Controller
{
	// サービスの説明
	const SERVICE_TITLE = 'めかぶ(MeCab)';
	const SERVICE_SUB_TITLE = 'PHPから利用とそのサンプルコード';
	const SERVICE_DESCRIPTION = 'テキストエリアに文字を入力して解析ボタンを押してください<br/>緑色のボタンでさらに加工されます。';
	const SERVICE_KEYWORD = 'php,fuelphp,mecab,sample';

	// 動作設定
	const MAX_CHARACTERS = 4000; // 最大文字数

	// プロパティ
	private $_str = ''; // 加工文字列
	private $_history = array(); // 実行結果の履歴

	/**
	 * 前処理
	 *
	 */
	public function before()
	{
		parent::before();
		// 加工文字列の初期設定
		$this->_str = "この世の中を！ウグッブーン！！！！\nゴノ、ゴノ世のブッヒィフエエエーーーンン！ア゛ー世の中を！".
			"ゥ変エダイ！その一心でええ！！ィヒーフーッハゥ。一生懸命訴えて、西宮市に、".
			"縁もゆかりもない西宮ッヘエ市民の皆さまに、選出されて！やっと！議員に！なったんですうぅぅぅ。".
			"&#13;> 野々村議員のマネと称して耳に手を添えるのが流行っていますが、手の位置は耳の後ろではなく前です。".
			" もう一度いいます。 手の位置は耳の前です。 ＿人人人人人人人人＿ ＞　話聞く気なし　＜ ".
			"（引用： 野々村クソコラbot@nonokora）";
	}

	/**
	 * 形態素解析の実行
	 *
	 * @return \Fuel\Core\View
	 */
	public function action_index()
	{
		// View生成 レイアウトビューを作成する
		$view = \View::forge('layout');
		// 画面の説明を設定
		$view->set_global('title', self::SERVICE_TITLE);
		$view->set_global('sub_title', self::SERVICE_SUB_TITLE);
		$view->set_global('description', self::SERVICE_DESCRIPTION, false);
		$view->set_global('keyword', self::SERVICE_KEYWORD);
		//View生成 変数としてビューを割り当てる、遅延レンダリング
		$view->head = \View::forge('head');
		$view->header = \View::forge('header');
		$view->top = \View::forge('top');
		$view->content = \View::forge('morphology/content');
		$view->footer = \View::forge('footer');
		// Model生成
		$morphology = new Morphology();
		// 処理対象の文字列取得
		$this->_str = !empty(\Input::post('input')) ? mb_strimwidth(\Input::post('input'), 0, self::MAX_CHARACTERS * 2, '', 'utf-8') : $this->_str;
		// 要求別設定
		switch (\Input::post('processing')) {
			case SERVICE_ROOT_KEY:
				// 解析
				$type_name = SERVICE_ROOT_NAME;
				break;
			case SERVICE_CLEAR_KEY:
				// クリア
				$type_name = SERVICE_CLEAR_NAME;
				$this->_str = '';
				\Session::delete_flash('morphology_history');
				// クリアを有効化
				$morphology->set_clear(true);
				break;
			case SERVICE_PUNCTUATION_REMOVE_KEY:
				// NG除去
				$type_name = SERVICE_PUNCTUATION_REMOVE_NAME;
				// NG除去を有効化
				$morphology->set_punctuation_remove(true);
				break;
			case SERVICE_DELETE_SYMBOL_KEY:
				// 記号一般除去
				$type_name = SERVICE_DELETE_SYMBOL_NAME;
				// 記号一般除去を有効化
				$morphology->set_delete_symbol(true);
				break;
			case SERVICE_CHANGE_PERIOD_KEY:
				// 改行句点化
				$type_name = SERVICE_CHANGE_PERIOD_NAME;
				// 記号一般除去を有効化
				$morphology->set_change_period(true);
				break;
			default :
				$type_name = SERVICE_ROOT_NAME;
				break;
		}
		// 形態素解析
		$morphology->set_str($this->_str);
		$morphology->analysis();
		$view->content->results = $morphology->get_results();
		// 解析結果から文章を取得
		$view->content->input = $morphology->get_text();
		// 処理結果に履歴を追加
		$csv = $morphology->get_csv();
		if (!empty($csv)) {
			$this->_history = \Session::get_flash('morphology_history');
			if (empty($this->_history)) $this->_history = array();
			array_unshift($this->_history, array('run_time' => date('H:i:s', time()), 'type_name' => $type_name, 'string' => $csv));
			\Session::set_flash('morphology_history', $this->_history);
		}
		$view->content->history = $this->_history;
		return $view;
	}

}
