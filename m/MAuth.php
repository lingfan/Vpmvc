<?php
/**
 * 
 * 用户认证
 * @author Administrator
 *
 */
class MAuth
{
	/**
	 * 
	 * 检查是否登陆
	 * @return array/bool
	 */
	static public function isLogin()
	{
		$info = self::getLoginCookie();
		if (isset($info['uid'])) {
			return true;
		}
		return false;
	}

	/**
	 * 
	 * 获取cookie中用户信息
	 * @return array/bool
	 */	
	static public function getLoginCookie()
	{
		$info = false;
		$args = array(
			'A' => FILTER_SANITIZE_STRING,
		);
		$formVals = filter_input_array(INPUT_COOKIE, $args);
		if (!empty($formVals['A'])) {
			$decodeStr = Crypt::decode($formVals['A']);
			$info = json_decode($decodeStr, true);
		}
		return $info;
	}
	
	/**
	 * 
	 * 把用户信息写入cookie
	 * @return array/bool
	 */
	static public function setLoginCookie($info)
	{
		if(!empty($info['uid']) && !empty($info['username'])) {
			$data = array(
				'uid' 		=> $info['uid'],
				'username' 	=> $info['username'],
			);
			$cookieStr = Crypt::encode(json_encode($data));
			$ret = setcookie('A', $cookieStr, time()+3600, '/', COOKIE_DOMAIN);
			return $ret;
		}
		return false;
	}
	
	/**
	 * 
	 * 清除cookie
	 * @return bool
	 */
	static public function unLoginCookie()
	{
		$ret = setcookie('A', '', time()-3600, '/', COOKIE_DOMAIN);
		return $ret;
	}
	
	
}