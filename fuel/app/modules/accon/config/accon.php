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
	 * サイト名（システム名）
	 */
	'site_name' => 'ACCON',

	/**
	 * 振舞い（DI設定）
	 */
	'behavior' => array(
		/**
		 * 認証
		 */
		'auth' => 'Accon\Foundation\Behavior_Auth_Simple',
//		'auth' => 'Accon\Foundation\Behavior_Auth_None',

		/**
		 * 物理的に存在するコントローラー
		 */
		'physical' => array(
			/**
			 * 認可
			 */
			'acl' => 'Accon\Foundation\Behavior_Acl_Physical',
//			'acl' => 'Accon\Foundation\Behavior_Acl_None',
			/**
			 * Crud
			 */
			'crud' => array(
				/**
				 * モデル操作
				 */
				'operation' => array(
					'insert' => 'Accon\Foundation\Behavior_Operation_Insert_Crud', // 追加
					'update' => 'Accon\Foundation\Behavior_Operation_Update_Crud', // 更新
					'remove' => 'Accon\Foundation\Behavior_Operation_Remove_Crud', // 削除
				),
				/**
				 * 画面生成
				 */
				'view' => array(
					'list'   => 'Accon\Foundation\Behavior_View_list_Crud',        // 一覧
					'single' => 'Accon\Foundation\Behavior_View_Single_Crud',      // 詳細
					'update' => 'Accon\Foundation\Behavior_View_Update_Crud',      // 更新
					'insert' => 'Accon\Foundation\Behavior_View_Insert_Crud',      // 追加
				),
			),
			/**
			 * Nested
			 */
			'nested' => array(
				/**
				 * モデル操作
				 */
				'operation' => array(
					'insert' => 'Accon\Foundation\Behavior_Operation_Insert_Nested', // 追加
					'update' => 'Accon\Foundation\Behavior_Operation_Update_Crud',   // 更新
					'remove' => 'Accon\Foundation\Behavior_Operation_Remove_Crud',   // 削除
				),
				/**
				 * 画面生成
				 */
				'view' => array(
					'list'   => 'Accon\Foundation\Behavior_View_list_Nested',        // 一覧
					'single' => 'Accon\Foundation\Behavior_View_Single_Crud',        // 詳細
					'update' => 'Accon\Foundation\Behavior_View_Update_Crud',        // 更新
					'insert' => 'Accon\Foundation\Behavior_View_Insert_Crud',        // 追加
				),
			),
		),

		/**
		 * 動的に生成されるコントローラー
		 */
		'kinetic' => array(
			/**
			 * 認可
			 */
			'acl' => 'Accon\Foundation\Behavior_Acl_Kinetic',
//			'acl' => 'Accon\Foundation\Behavior_Acl_None',
			/**
			 * Nested
			 */
			'nested' => array(
				/**
				 * 画面生成
				 */
				'view' => array(
					'list'   => 'Accon\Foundation\Behavior_View_list_Nested', // 一覧
				),
			),
		),

		/**
		 * レストコントローラー
		 */
		'rest' => array(
			/**
			 * 認可
			 */
			'acl' => 'Accon\Foundation\Behavior_Acl_Rest',
//			'acl' => 'Accon\Foundation\Behavior_Acl_None',
		),
	),

	/**
	 * オペレーションログ出力設定
	 * 		true： 出力
	 * 		false: 出力しない
	 */
	'operation_log'  => true,

	/**
	 * ブラウザコンソールログ出力設定
	 * 		true： 出力
	 * 		false: 出力しない
	 */
	 'browser_console'  => true,

	/**
	 * ロール権限リスト
	 */
	'roll_authorization_list' => array(
		array(
			'key' => '',
			'val' => '',
		),
		array(
			'key' => 'A',
			'val' => '全て許可',
		),
		array(
			'key' => 'R',
			'val' => '取消',
		),
		array(
			'key' => 'D',
			'val' => '全て拒否',
		),
	),

);
