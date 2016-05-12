<?php 
class Logger
{
	static public function error($msg, $func_name='', $params='')
	{
		return self::write($msg, 'error');	
	}
	
	static public function debug($msg, $func_name='', $params='')
	{
		return self::write($msg, 'debug');	
	}

	static public function warn($msg, $func_name='', $params='')
	{
		return self::write($msg, 'warn');	
	}
	
	static public function write($msg, $type)
	{
		$path = RUNTIME_PATH.'/logs/';
		$logFile = $path.$type.'_'.date('Ymd').'.log';
		$now = date('Y-m-d H:i:s');
		$msg = "[{$now}] {$msg} \n";
		error_log($msg, 3, $logFile);
	}
}
?>