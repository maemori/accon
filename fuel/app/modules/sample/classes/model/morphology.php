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

namespace Sample\Model;

// モデル内定数
define('KEYWORD_SYMBOL', '記号');
define('KEYWORD_GENERAL', '一般');
define('KEYWORD_PERIOD', '句点');
define('KEYWORD_PERIOD_SYMBOL', '。');
// 文字分析用定数
define('LINE_BREAGK', serialize(array(PHP_EOL, '<br>', '<br/>', '<br />')));

/**
 * 形態素解析モデル
 *
 * 形態素解析に関わる処理を行う.
 */
class Morphology extends \Model
{
	private $_mecab; // 形態素解析エンジン
	private $_str = ''; // 加工元文字列
	private $_analysis = array(); // 加工結果
	private $_change_period = false; // 改行句点化
	private $_clear = false; // クリア
	private $_delete_symbol = false; // 記号一般除去除去
	private $_punctuation_remove = false; // NG除去

	const NON = "*"; // 除去文字

	/**
	 * コンストラクタ
	 */
	function __construct()
	{
		$this->mecab = new \MeCab_Tagger();
	}

	/**
	 * 改行句点化有無設定
	 *
	 * @access  public
	 * @param   boolean
	 */
	public function set_change_period($flag)
	{
		$this->_change_period = $flag;
	}

	/**
	 * クリアの有無設定
	 *
	 * @access  public
	 * @param   boolean
	 */
	public function set_clear($flag)
	{
		$this->_clear = $flag;
	}

	/**
	 * 処理結果から文字列を返す
	 *
	 * @access  public
	 * @return  string
	 */
	public function get_csv()
	{
		$str = '';
		foreach ($this->_analysis as $node) {
			if (empty($str)) {
				$str = $node['surface'];
			} else {
				$str = $str.','.$node['surface'];
			}
		}
		return $str;
	}

	/**
	 * 記号一般除去除去の有無設定
	 *
	 * @access  public
	 * @param   boolean
	 */
	public function set_delete_symbol($flag)
	{
		$this->_delete_symbol = $flag;
	}

	/**
	 * NG除去の有無設定
	 *
	 * @access  public
	 * @param   boolean
	 */
	public function set_punctuation_remove($flag)
	{
		$this->_punctuation_remove = $flag;
	}

	/**
	 * 処理対象文字列の返す
	 *
	 * @access  public
	 * @return  array
	 */
	public function get_results()
	{
		return $this->_analysis;
	}

	/**
	 * 処理対象文字列のセット
	 *
	 * @access  public
	 * @param   string
	 */
	public function set_str($str)
	{
		$this->_str = $str;
	}

	/**
	 * 処理結果から文字列を返す
	 *
	 * @access  public
	 * @return  string
	 */
	public function get_text()
	{
		$str = '';
		foreach ($this->_analysis as $node) {
			$str = $str.$node['surface'];
		}
		return $str;
	}

	/**
	 * 形態素解析の実行
	 *
	 * @access  public
	 * @return  array
	 *   surface                : 単語
	 *   isbest                 : bestなら1
	 *   stat                   : 普通 0,未知語 1
	 *   part_apeech            : 品詞
	 *   part_apeech_classify_1 : 品詞細分類1
	 *   part_apeech_classify_2 : 品詞細分類2
	 *   part_apeech_classify_3 : 品詞細分類3
	 *   inflected              : 活用形
	 *   use_type               : 活用型
	 *   original               : 原形
	 *   reading                : 読み
	 *   pronunciation          : 発音
	 */
	public function analysis()
	{
		// 改行句点化有りの場合、句点化を行う。
		if ($this->_change_period) $this->_optimize_period();
		// 形態素解析の実行
		$nodes = $this->mecab->parseToNode($this->_str);
		foreach ($nodes as $node) {
			if (!empty($node->surface)) {
				$data = explode(',', $node->feature);
				// クリア以外実行
				if ((!$this->_clear) and (
						!(($this->_punctuation_remove) and ($node->stat == 1)) and
						!(($this->_delete_symbol and $data[0] == KEYWORD_SYMBOL) and ($data[1] == KEYWORD_GENERAL)))
				) {
					// 要素の格納
					array_push($this->_analysis,
						array('surface' => $node->surface,
							'isbest' => $node->isbest,
							'stat' => $node->stat,
							'part_apeech' => (!$node->stat) ? $data[0] : '',
							'part_apeech_classify_1' => (!($node->stat) and !($data[1] == self::NON)) ? $data[1] : '',
							'part_apeech_classify_2' => (!($node->stat) and !($data[2] == self::NON)) ? $data[2] : '',
							'part_apeech_classify_3' => (!($node->stat) and !($data[3] == self::NON)) ? $data[3] : '',
							'inflected' => (!($node->stat) and !($data[4] == self::NON)) ? $data[4] : '',
							'use_type' => (!($node->stat) and !($data[5] == self::NON)) ? $data[5] : '',
							'original' => (!($node->stat) and !($data[6] == self::NON)) ? $data[6] : '',
							'reading' => (!($node->stat) and !($data[7] == self::NON)) ? $data[7] : '',
							'pronunciation' => (!($node->stat) and !($data[8] == self::NON)) ? $data[8] : ''
						)
					);
				}
			}
		}
	}

	// 句点と改行を最適化
	private function _optimize_period()
	{
		// 連続した句点を統合
		foreach (unserialize(LINE_BREAGK) as $node) {
			$this->_str = mb_ereg_replace('('.$node.')', KEYWORD_PERIOD_SYMBOL, $this->_str);
		}
		$this->_str = str_replace(array("\r\n", "\n", "\r"), '', $this->_str);
		// 文中の連続句点を除去
		$this->_str = mb_ereg_replace(KEYWORD_PERIOD_SYMBOL.'('.KEYWORD_PERIOD_SYMBOL.'*)', KEYWORD_PERIOD_SYMBOL, $this->_str);
		// 文最後の連続句点を除去
		$this->_str = mb_ereg_replace(KEYWORD_PERIOD_SYMBOL.'('.KEYWORD_PERIOD_SYMBOL.'*)$', KEYWORD_PERIOD_SYMBOL, $this->_str);
	}
}