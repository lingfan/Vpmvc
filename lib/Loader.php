<?php
/**
 *  自动加载类库
 */
class Loader
{
	public static function libAutoLoader($class)
	{
		$classFile = ROOT_PATH.'/lib/'.$class.'.php';
		if (is_readable($classFile)) {
			require_once $classFile;
		}
	}
	
	public static function mAutoLoader($class)
	{
		$classFile = ROOT_PATH.'/m/'.$class.'.php';
		if (is_readable($classFile)) {
			require_once $classFile;
		}
	}
	
	public static function cAutoLoader($class)
	{
		$classFile = ROOT_PATH.'/c/'.$class.'.php';
		if (is_readable($classFile)) {
			require_once $classFile;
		}
	}
	
	public static function loadLib($file)
	{
		$classFile = ROOT_PATH.'/lib/'.$file;
		if (is_readable($classFile)) {
			require_once $classFile;
		} else {
			throw new VException("{$classFile}不存在,类库无法加载");
		}
	}
}

spl_autoload_register('Loader::libAutoLoader');
spl_autoload_register('Loader::mAutoLoader');
spl_autoload_register('Loader::cAutoLoader');