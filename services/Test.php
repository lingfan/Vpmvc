<?php
class Test
{
	public function str()
	{
		return 'str';
	}
	
	public function arr()
	{
		return array(1,2,3,4);
	}
	
	public function obj()
	{
		$o = new stdClass;
		$o->a =1;
		$o->b = 2;
		
		return $o;
	}
	
	public function set($value)
	{
		return $value;
	}
	
	public function setcookie()
	{
		$value = date('Y-m-d H:i:s');
		setcookie("TestCookie", $value, time()+3600);
		return $_COOKIE['TestCookie'];
	}
	
	public function getcookie()
	{
		return $_COOKIE['TestCookie'];
	}
	
	public function uncookie()
	{
		setcookie("TestCookie", '', time()-3600);
		return isset($_COOKIE['TestCookie'])?1:0;
	}
}