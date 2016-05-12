<?php
/*
 * 用户控制器
 */
class CMember
{
	static public function AIndex()
	{
		if (!MAuth::isLogin()) {
			Common::redirect('?r=member/login');
		}
		$loginInfo = MAuth::getLoginCookie();
		var_dump($loginInfo);
	}
	
	/*
	 * 注册
	 */
	static public function ARegister()
	{
		$ret = false;
		$err = array();
		$args = array(
			'username' 		=> FILTER_SANITIZE_STRING,
			'password' 		=> FILTER_SANITIZE_STRING,
			'repassword' 	=> FILTER_SANITIZE_STRING,
			'email' 		=> FILTER_VALIDATE_EMAIL,
		);
		$formVals = filter_var_array($_REQUEST, $args);
		
		if (empty($formVals['username'])) {
			$err['username'] = '用户名非法';
		}
		if (empty($formVals['password'])) {
			$err['password'] = '密码非法';
		} else if ($formVals['password'] != $formVals['repassword']) {
			$err['password'] = '密码错误';
		}
		if (empty($formVals['email'])) {
			$err['email'] = 'Email错误';	
		}
		if ( count($err) == 0 ) {
			$memberInfo = MMember::getMemberInfoByUsername($formVals['username']);
			if (!$memberInfo) {
				$formVals['password'] = sha1($formVals['password']);
				$uid = MMember::insert($formVals);
				if ($uid) {
					$memberInfo = MMember::getMemberInfo($uid);
					$ret = MAuth::setLoginCookie($memberInfo);
					$content = View::load('email/register');
					$bSend = MEmail::send('注册成功', $content, $formVals['email']);
					var_dump($bSend);
					exit;
					Common::redirect('?r=member/index');
				}
			}
		}
		$result['success'] = $ret;
		$result['message'] = $err;
		var_dump($result);
		View::render('register');
		exit;
		
		return json_encode($result);
		
	}
	
	/*
	 * 登陆
	 */
	static public function ALogin()
	{
		if (MAuth::isLogin()) {
			Common::redirect('?r=member/index');
		}
		$args = array(
			'username' 		=> FILTER_SANITIZE_STRING,
			'password' 		=> FILTER_SANITIZE_STRING,
		);
		$formVals = filter_var_array($_REQUEST, $args);
		
		if (!empty($formVals['username']) && !empty($formVals['password'])) {
			$formVals['password'] = sha1($formVals['password']);
			$loginInfo = MMember::verifyLogin($formVals);
			if ($loginInfo) {
				MAuth::setLoginCookie($loginInfo);
				Common::redirect('?r=member/index');
			}	
		}
		
		View::render('login');
	}
	
	/*
	 * 登出
	 */
	static public function ALogout()
	{
		$ret = MAuth::unLoginCookie();
		Common::redirect('?r=index/index');
	}
	
	
}