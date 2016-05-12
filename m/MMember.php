<?php
/**
 * 用户模块
 * @author 胡威 <william.hu@live.com>
 *
 */
class MMember
{
	/**
	 * 插入用户信息
	 * @param  array $info (username, password, email)
	 * @return bool/int
	 */
	static public function insert(Array $info)
	{
		$sql = 'INSERT INTO member SET username=:username, password=:password, email=:email, register_time=:register_time';
		$sth = DB::getDBH()->prepare($sql);
		$sth->bindParam(':username', 		$info['username']);
		$sth->bindParam(':password', 		$info['password']);
		$sth->bindParam(':email', 			$info['email']);
		$sth->bindParam(':register_time', 	date('Y-m-d H:i:s'));
		$ret = $sth->execute();
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>$info,);
			Logger::error(serialize($msg));
			return false;
		}
		$id = DB::getDBH()->lastInsertId();
		return $id;
	}
	
	/**
	 * 
	 * 验证用户登陆
	 * @param array $info (username, password)
	 * @return bool/array
	 */
	static public function verifyLogin(Array $info)
	{
		$sql = 'SELECT uid, username FROM member WHERE username=:username AND password=:password';
		$sth = DB::getDBH()->prepare($sql);
		$sth->bindParam(':username', 		$info['username']);
		$sth->bindParam(':password', 		$info['password']);
		$ret = $sth->execute();
		$row = $sth->fetch(PDO::FETCH_ASSOC);
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>$info,);
			Logger::error(serialize($msg));
			return false;
		}
		return isset($row['uid']) ? $row : false;
	}
	
	/**
	 * 
	 * 通过用户id获取信息
	 * @param int $id
	 * @return array/bool
	 */
	static public function getMemberInfo($id)
	{
		$sql = 'SELECT * FROM member WHERE uid=:uid';
		$sth = DB::getDBH()->prepare($sql);
		$sth->bindParam(':uid', $id);
		$ret = $sth->execute();
		$row = $sth->fetch(PDO::FETCH_ASSOC);
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>$info,);
			Logger::error(serialize($msg));
			return false;
		}
		return isset($row['uid']) ? $row : false;
	}
	
	/**
	 * 
	 * 通过用户username获取信息
	 * @param string $username
	 * @return array/bool
	 */
	static public function getMemberInfoByUsername($username)
	{
		$sql = 'SELECT * FROM member WHERE username=:username';
		$sth = DB::getDBH()->prepare($sql);
		$sth->bindParam(':username', $username);
		$ret = $sth->execute();
		$row = $sth->fetch(PDO::FETCH_ASSOC);
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>$info,);
			Logger::error(serialize($msg));
			return false;
		}
		return isset($row['uid']) ? $row : false;
	}
	
	/**
	 * 
	 * 更新用户金币和赠卷
	 * @param array $info (uid, gold, coupon)
	 * @return bool
	 */
	static public function updateGold(Array $info)
	{
		$condition = array();
		if (isset($info['gold'])) {
			$condition[] = 'gold =:gold';
		}
		if (isset($info['coupon'])) {
			$condition[] = 'coupon =:coupon';
		}
		$set = implode(',', $condition);
		$sql = 'UPDATE member SET '.$set.' WHERE uid = :uid';
		$sth = DB::getDBH()->prepare($sql);
		if (isset($info['gold'])) {
			$sth->bindParam(':gold', 	$info['gold']);
		}
		if (isset($info['coupon'])) {
			$sth->bindParam(':coupon', 	$info['coupon']);
		}
		$sth->bindParam(':uid', 	$info['uid']);
		$ret = $sth->execute();
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>$info,);
			Logger::error(serialize($msg));
			return false;
		}
		return true;
	}
	
	/**
	 * 
	 * 正常0,放假1
	 * @param array $info (uid, vacation)
	 * @return bool
	 */
	static public function updateVacation(Array $info)
	{
		$sql = 'UPDATE member SET vacation=:vacation WHERE uid = :uid';
		$sth = DB::getDBH()->prepare($sql);
		$sth->bindParam(':vacation', $info['vacation']);
		$sth->bindParam(':uid', $info['uid']);
		$ret = $sth->execute();
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>$info,);
			Logger::error(serialize($msg));
			return false;
		}
		return true;
	}
	
	/**
	 * 
	 * 正常0,休整1
	 * @param array $info (uid, rest)
	 * @return bool
	 */
	static public function updateRest(Array $info)
	{
		$sql = 'UPDATE member SET rest=:rest WHERE uid = :uid';
		$sth = DB::getDBH()->prepare($sql);
		$sth->bindParam(':rest', $info['rest']);
		$sth->bindParam(':uid', $info['uid']);
		$ret = $sth->execute();
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>$info,);
			Logger::error(serialize($msg));
			return false;
		}
		return true;
	}
	
	/**
	 * 
	 * 用户图像
	 * @param array $info (uid, avatar)
	 * @return bool
	 */
	static public function updateAvatar(Array $info)
	{
		$sql = 'UPDATE member SET avatar=:avatar WHERE uid = :uid';
		$sth = DB::getDBH()->prepare($sql);
		$sth->bindParam(':avatar', $info['avatar']);
		$sth->bindParam(':uid', $info['uid']);
		$ret = $sth->execute();
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>$info,);
			Logger::error(serialize($msg));
			return false;
		}
		return true;
	}
	
	/**
	 * 
	 * 更新最后登陆时间和IP
	 * @param array $info (uid, last_login_ip, last_login_time)
	 * @return bool
	 */
	static public function updateLastLogin(Array $info)
	{
		$sql = 'UPDATE member SET last_login_ip=:last_login_ip, last_login_time=:last_login_time WHERE uid = :uid';
		$sth = DB::getDBH()->prepare($sql);
		$sth->bindParam(':last_login_ip', $info['last_login_ip']);
		$sth->bindParam(':last_login_time', date('Y-m-d H:i:s'));
		$sth->bindParam(':uid', $info['uid']);
		$ret = $sth->execute();
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>$info,);
			Logger::error(serialize($msg));
			return false;
		}
		return true;
	}
	
	/**
	 * 
	 * 更新主城ID
	 * @param array $info (uid, master_castle_id)
	 * @return bool
	 */
	static public function updateMasterCastleID(Array $info)
	{
		$sql = 'UPDATE member SET master_castle_id=:master_castle_id WHERE uid = :uid';
		$sth = DB::getDBH()->prepare($sql);
		$sth->bindParam(':master_castle_id', $info['master_castle_id']);
		$sth->bindParam(':uid', $info['uid']);
		$ret = $sth->execute();
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>$info,);
			Logger::error(serialize($msg));
			return false;
		}
		return true;
	}
}
?>