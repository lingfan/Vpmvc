<?php
/**
 * 
 * 系统配置模块
 * @author william.hu
 * @version 2010/10/12
 */ 
class MConfig
{
	/**
	 * 
	 * 获取系统配置数据
	 * @param string $key 如果key不为空,就显示对应的值
	 * @return array/string
	 */
	public static function getData($key='')
	{
		$sql = 'SELECT * FROM sys_config ';
		$sth = DB::getDBH()->prepare($sql);
		$ret = $sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>$uid,);
			Logger::error(serialize($msg));
			return false;
		}
		if (!empty($key)) {
			return isset($rows[$key])?$rows[$key]:'';
		}
		return $rows;
	}
	
	/**
	 * 
	 * 更新系统配置数据
	 * @param string $key
	 * @param string $val
	 * @return bool
	 */
	public static function setData($key, $val)
	{
		$set = " SET {$val}=:{$val}";
		$where = " WHERE {$key}=:{$key}";
		$sql = 'UPDATE member '.$set.$where;
		$sth = DB::getDBH()->prepare($sql);
		$sth->bindParam(":{$val}", $val);
		$ret = $sth->execute();
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>array($key,$val),);
			Logger::error(serialize($msg));
			return false;
		}
		return true;
	}
}
?>