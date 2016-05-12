<?php
/**
 * 
 * 公共类库
 * @author 胡威
 *
 */
class Common
{
	static public function redirect($url)
	{
		header('Location:'.$url);
		exit;
	} 
}