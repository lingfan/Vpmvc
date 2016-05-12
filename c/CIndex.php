<?php 
class CIndex
{
	public function AIndex()
	{
		$loginInfo = MAuth::getLoginCookie();
		var_dump($loginInfo);
		echo 'hello';
	}
}
?>