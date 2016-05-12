<?php
/**
 *
 * 城堡控制器
 */
class CCastle
{
	static protected function init()
	{
		if (!MAuth::isLogin()) {
			Common::redirect('?r=member/login');
		}
		$loginInfo = MAuth::getLoginCookie();
		return $loginInfo;
	}
	/**
	 * 
	 * 城堡状况
	 */
	static public function AIndex()
	{
		$owner = self::init();
		$castleArr = MCastle::getMemberCastleByUid($owner['uid']);
		if (count($castleArr) == 0) {
			MCastle::init($owner);
		}
	}
	
	/**
	 * 
	 * 创建城堡
	 */
	static public function AMake()
	{
		
	}
	
	/**
	 * 
	 * 人口状况
	 */
	static public function APeople()
	{
	
	}
	
	/**
	 * 
	 * 军库状况
	 */
	static public function AArmoury()
	{
		
	}
	
	/**
	 * 
	 * 移入军库
	 */
	static public function AArmouryShiftIn()
	{
		
	}
	
	/**
	 * 
	 * 移出军库
	 */
	static public function AArmouryShiftOut()
	{
		
	}
}