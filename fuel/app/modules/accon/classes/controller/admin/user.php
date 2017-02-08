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

namespace Accon;

use Accon\Model\User;
use Accon\Model\Group;
use \Auth\Auth;

/**
 * Class Controller_Admin_User
 *
 * ユーザ管理
 *
 * アクション実装サンプル
 */
class Controller_Admin_User extends Foundation\Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'ユーザ';
	// モデルクラス
	const MODEL = User::class;

	/**
	 * view action.
	 *
	 * @param null $id
	 * @return \Fuel\Core\View
	 */
	protected function view($id = null)
	{
		// viewの構築
		return $this->view_single($id,false);
	}

	/**
	 * edit action.
	 *
	 * @param null $id
	 * @return \Fuel\Core\View
	 */
	protected function edit($id = null)
	{
		// viewの構築
		$view = $this->view_update($id, false);
		// モデルへ値設定
		if (\Input::method() == POST) {
			// 画面の値を設定
			$view->model->username = \Input::post('username');
			$view->model->group_id = \Input::post('group_id');
			$view->model->email = \Input::post('email');
		}
		return $view;
		// Validationの実行
	}

	/**
	 * create action.
	 *
	 * @return \Fuel\Core\View
	 * @throws \Exception
	 */
	public function create()
	{
		// viewの構築
		$view = $this->view_insert();
		// モデルへ値設定
		if (\Input::method() == POST) {
			// 画面の値を設定
			$view->model->username = \Input::post('username');
			$view->model->password = \Input::post('password');
			$view->model->group_id = \Input::post('group_id');
			$view->model->email = \Input::post('email');
			$view->model->last_login = 0;
			$view->model->previous_login = 0;
			$view->model->login_hash = 0;
		}
		if (\Input::post(PROCESSING) == SUBMIT_CREATE) {
			// パスワード・確認用パスワードの確認
			$verify_password = \Input::post('verify_password');
			if (!strcmp($view->model->password, $verify_password)) {
				// Validationの追加
				$view->val->add_field('password', 'Password', 'required|max_length[255]');
				$view->val->add_field('verify_password', 'verify_password', 'required|max_length[255]');
				$view->model->password = Auth::instance()->hash_password($view->model->password);
			} else {
				// パスワード・確認用パスワードの不一致
				\Session::set_flash('error', ERROR_PASSWORD_MISMATCH_MESSAGE);
				$view->model->password = '';
			}
		}
		// Viewを返す
		return $view;
	}

	/**
	 * delete action.
	 *
	 * @param null $id
	 */
	protected function delete($id = null)
	{
		// IDが0の場合、システムで使用しているため削除不可
		if ($id == 0){
			\Session::set_flash('error', ERROR_NOT_REMOVED_USED_SYSTEM.' ID:'.$id);
			\Response::redirect(\Session::get('return_url'));
		};
		// 削除
		$this->model_remove($id);
	}

	/**
	 * view描写前補完
	 *
	 * @param \View $view
	 * @return \View
	 */
	protected function view_after(\View $view = null){
		// アクセス権限を設定
		$view->set_permission('group',$this->authority('/accon/admin', 'group', 'view'));
		$view->set_permission('password',$this->authority('/accon/admin', 'user', 'password'));
		// Viewにグループをセット
		$group_list = \Arr::assoc_to_keyval(Group::find('all', array('order_by' => array('name' => 'asc'))), 'name', 'id');
		$view->set_global('group_list', array_flip(array_merge(array('' => ''), $group_list)));
		return $view;
	}

	/**
	 * password action.
	 *
	 * パスワードの変更（管理）
	 * @param null $id
	 * @return \Fuel\Core\View
	 * @throws \Exception
	 */
	public function action_password($id = null)
	{
		// Viewの生成
		$view = $this->view_creator(\View::forge($this->get_base_url().'password'), false);
		// パラメータの確認
		is_null($id) and \Response::redirect($this->get_controller_url());
		if (!$model = User::find($id)) {
			// 不正なパラメータ
			\Session::set_flash('error', 'Could not find user #'.$id);
			\Response::redirect(\Session::get('return_url'));
		}
		// Validationの設定
		$val = \Validation::forge('password');
		$val->add_field('password', 'Password', 'required|max_length[255]');
		$val->add_field('verify_password', 'verify_password', 'required|max_length[255]');
		// 画面入力値取得
		$model->password = \Input::post('password');
		$verify_password = \Input::post('verify_password');
		// Validationの実行
		if ($val->run()) {
			// パスワード・確認用パスワードの確認
			if (!strcmp($model->password, $verify_password)) {
				// パスワード暗号化
				$model->password = Auth::instance()->hash_password($model->password);
				// 更新ユーザIDのセット
				list(, $user_id) = Auth::get_user_id();
				$model->user_id = $user_id;
				// Userモデルの保存
				if ($model->save()) {
					\Session::set_flash('success', SUCCESS_UPDATE_MESSAGE.'.Id:'.$id);
					\Response::redirect(\Session::get('return_url'));
				} else {
					\Session::set_flash('error', ERROR_UPDATE_MESSAGE.'.Id:'.$id);
				}
			} else {
				// パスワード・確認用パスワードの不一致
				\Session::set_flash('error', ERROR_PASSWORD_MISMATCH_MESSAGE);
			}
		}
		// ViewのMenu部品のパスをセット
		$view->set_global('view_menu', MODULE.'::'.self::ACCON_MENU, false);
		// Viewに結果をセット
		$view->set_global('model', $model, false);
		$view->set_global('verify_password', $verify_password, false);
		// Validation結果
		$view->content->val = $val;
		return $view;
	}

	/**
	 * register action.
	 *
	 * ユーザ作成（一般）
	 * @return \View
	 * @throws \Exception
	 */
	public function action_register()
	{
		// メニューのログイン非表示判定用
		\Session::set_flash('Logged', true);
		// viewの構築
		$view = $this->view_insert(false);
		// モデルへ値設定
		$model = User::forge(array(
			'username' => \Input::post('username'),
			'password' => \Input::post('password'),
			'group_id' => DEFAULT_GROUP_ID,
			'email' => \Input::post('email'),
			'last_login' => 0,
			'previous_login' => 0,
			'login_hash' => 0,
		));
		$view->set_global('model', $model, false);
		// 作成
		if (\Input::post(PROCESSING) == SUBMIT_CREATE) {
			// パスワード・確認用パスワードの確認
			$verify_password = \Input::post('verify_password');
			if (!strcmp($model->password, $verify_password)) {
				// Validationの追加
				$view->val->add_field('password', 'Password', 'required|max_length[255]');
				$view->val->add_field('verify_password', 'verify_password', 'required|max_length[255]');
				// Validationの実行しモデルの保存
				if ($view->val->run(array('group_id' => DEFAULT_GROUP_ID))) {
					$model->password = Auth::instance()->hash_password($model->password);
					\Session::set('return_url', '/');
					try {
						// モデルの更新
						if ($model->save()) {
							\Log::operation('[MODEL INSERT], USER ID:'.$model->id.', DATA:'.print_r($model->to_array(), true), __METHOD__);
							\Session::set_flash('success', SUCCESS_UPDATE_MESSAGE.'.Id:'.$model->id);
							\Session::get_flash('Logged');
							\Response::redirect(\Session::get('return_url'));
						} else {
							\Session::set_flash('error', ERROR_UPDATE_MESSAGE);
						}
					} catch (\Exception $e) {
						if ($e->getCode() == DATABASE_INTEGRITY_VIOLATION_CODE) {
							\Session::set_flash('error', ERROR_DATABASE_INTEGRITY_VIOLATION);
						} else {
							throw $e;
						}
					}
				}
			} else {
				// パスワード・確認用パスワードの不一致
				\Session::set_flash('error', ERROR_PASSWORD_MISMATCH_MESSAGE);
			}
		}
		// Viewを返す
		return $this->view_after($view);
	}

	/**
	 * register modify.
	 *
	 * ユーザ情報変更（変更）
	 * @return \Fuel\Core\View
	 * @throws \Exception
	 */
	public function action_modify()
	{
		// Viewの生成
		$view = $this->view_creator(\View::forge($this->get_base_url().'edit'), false);
		// ログインユーザで変更アクションを実行
		$user_id = Auth::get_user_id();
		// モデルの取得
		if (!$model = User::find($user_id[1])) {
			\Session::set_flash('error', ERROR_DATA_NOT_EXIST_MESSAGE.' ID:'.$user_id[1]);
			\Response::redirect(\Session::get('return_url'));
		}
		// Validationの設定
		$val = \Validation::forge('modify_password');
		$val->add_field('verify_password', 'Verify password', 'required|max_length[255]');
		// 画面入力値取得
		$verify_password = \Input::post('verify_password');
		$username = \Input::post('username');
		$email = \Input::post('email');
		if ($val->run()) {
			// パスワード・確認用パスワードの確認
			$hash_verify_password = Auth::instance()->hash_password($verify_password);
			if ($model->password === $hash_verify_password) {
				// 値の設定
				$model->username = $username;
				$model->email = $email;
				try {
					// モデルの更新
					if ($model->save()) {
						\Log::operation('[MODEL UPDATE], USER ID:'.$user_id[1].', DATA:'.print_r($model->to_array(), true), __METHOD__);
						\Session::set_flash('success', SUCCESS_UPDATE_MESSAGE.'.Id:'.$user_id[1]);
						\Response::redirect(\Session::get('return_url'));
					} else {
						\Session::set_flash('error', ERROR_UPDATE_MESSAGE.'.Id:'.$user_id[1]);
					}
				} catch (\Exception $e) {
					if ($e->getCode() == DATABASE_INTEGRITY_VIOLATION_CODE) {
						\Session::set_flash('error', ERROR_DATABASE_INTEGRITY_VIOLATION);
					} else {
						throw $e;
					}
				}
			} else {
				// パスワード・確認用パスワードの不一致
				\Session::set_flash('error', ERROR_PASSWORD_MISMATCH_MESSAGE);
			}
		}
		// ViewのMenu部品のパスをセット
		$view->set_global('view_menu', MODULE.'::'.self::ACCON_MENU, false);
		// Viewに結果をセット
		$view->set_global('model', $model, false);
		// Validation結果
		$view->set_global('val', $val, false);
		return $view;
	}

	/**
	 * register modify_password.
	 *
	 * @return \Fuel\Core\View
	 * @throws \Exception
	 */
	public function action_modify_password()
	{
		// Viewの生成
		$view = $this->view_creator(\View::forge($this->get_base_url().'modify_password'), false);
		// ログインユーザで変更アクションを実行
		$user_id = Auth::get_user_id();
		// モデルの取得
		if (!$model = User::find($user_id[1])) {
			\Session::set_flash('error', ERROR_DATA_NOT_EXIST_MESSAGE.' ID:'.$user_id[1]);
			\Response::redirect(\Session::get('return_url'));
		}
		// Validationの設定
		$val = \Validation::forge('modify_password');
		$val->add_field('old_password', 'Old password', 'required|max_length[255]');
		$val->add_field('new_password', 'New password', 'required|max_length[255]');
		$val->add_field('verify_password', 'Verify password', 'required|max_length[255]');
		// 画面入力値取得
		$old_password = \Input::post('old_password');
		$new_password = \Input::post('new_password');
		$verify_password = \Input::post('verify_password');
		// Validationの実行
		if ($val->run()) {
			// パスワード・確認用パスワードの確認
			$hash_old_password = Auth::instance()->hash_password($old_password);
			$hash_new_password = Auth::instance()->hash_password($new_password);
			if (($model->password === $hash_old_password)
				and ($new_password === $verify_password)) {
				// Passwordの保存
				$model->password = $hash_new_password;
				try {
					// モデルの更新
					if ($model->save()) {
						\Log::operation('[MODEL UPDATE], USER ID:'.$user_id[1].', DATA:'.print_r($model->to_array(), true), __METHOD__);
						\Session::set_flash('success', SUCCESS_UPDATE_MESSAGE.'.Id:'.$user_id[1]);
						\Response::redirect(\Session::get('return_url'));
					} else {
						\Session::set_flash('error', ERROR_UPDATE_MESSAGE.'.Id:'.$user_id[1]);
					}
				} catch (\Exception $e) {
					if ($e->getCode() == DATABASE_INTEGRITY_VIOLATION_CODE) {
						\Session::set_flash('error', ERROR_DATABASE_INTEGRITY_VIOLATION);
					} else {
						throw $e;
					}
				}
			} else {
				// パスワード・確認用パスワードの不一致
				\Session::set_flash('error', ERROR_PASSWORD_MISMATCH_MESSAGE);
			}
		}
		// ViewのMenu部品のパスをセット
		$view->set_global('view_menu', MODULE.'::'.self::ACCON_MENU, false);
		// Viewに結果をセット
		$view->set_global('model', $model, false);
		$view->set_global('old_password', $old_password, false);
		$view->set_global('new_password', $new_password, false);
		$view->set_global('verify_password', $verify_password, false);
		// Validation結果
		$view->set_global('val', $val, false);
		return $view;
	}

}
