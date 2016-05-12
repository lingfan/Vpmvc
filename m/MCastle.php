<?php
/**
 * 
 * 城堡模块
 * @author william.hu
 * @version 2010/11/12
 */ 
class MCastle
{
	public static function init()
	{
		
	}
	
	
	
	/**
	 * 
	 * 通过用户ID获取城堡信息
	 * @param int $id
	 * @return array
	 */
	public static function getMemberCastleByUid($uid)
	{
		$sql = 'SELECT * FROM castle WHERE owner=:owner ';
		$sth = DB::getDBH()->prepare($sql);
		$sth->bindParam(':owner', $uid);
		$ret = $sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>$uid,);
			Logger::error(serialize($msg));
			return false;
		}
		return $rows;
	}
	
	/**
	 * 
	 * 通过城堡ID获取城堡信息
	 * @param int $id
	 * @return array
	 */
	public static function getMemberCastleByID($id)
	{
		$sql = 'SELECT * FROM castle WHERE id=:id';
		$sth = DB::getDBH()->prepare($sql);
		$sth->bindParam(':id', $id);
		$ret = $sth->execute();
		$row = $sth->fetch(PDO::FETCH_ASSOC);
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>$id,);
			Logger::error(serialize($msg));
			return false;
		}
		return $row;
	}
	
	/**
	 * 
	 * 建立新城堡
	 * @param array $info (castle_name, owner, pos_x, pos_y, pos_z, terrain, people, created_at, last_update)
	 * @return bool/int
	 */
	public static function makeNew(Array $info)
	{
		$sql = 'INSERT INTO castle SET castle_name=:castle_name, owner=:owner, pos_x=:pos_x, pos_y=:pos_y, 
		pos_z=:pos_z, terrain=:terrain, people=:people, created_at=:created_at, last_update=:last_update';
		$sth = DB::getDBH()->prepare($sql);
		$sth->bindParam(':castle_name', $info['castle_name']);
		$sth->bindParam(':owner', 		$info['uid']);
		$sth->bindParam(':pos_x', 		$info['pos_x']);
		$sth->bindParam(':pos_y', 		$info['pos_y']);
		$sth->bindParam(':pos_z', 		$info['pos_z']);
		$sth->bindParam(':terrain', 	$info['terrain']);
		$sth->bindParam(':people', 		$info['people']);
		$sth->bindParam(':created_at', 	date('Y-m-d H:i:s'));
		$sth->bindParam(':last_update', time());
		$ret = $sth->execute();
		if (!$ret) {
			$msg = array('function'=> __METHOD__, 'error'=> $sth->errorInfo(), 'params'=>$info,);
			Logger::error(serialize($msg));
			return false;
		}
		$id = DB::getDBH()->lastInsertId();
		return $id;
	}
	
	
}
?>