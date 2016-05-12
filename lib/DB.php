<?php
/**
 *  数据库类库
 */
class DB
{
	protected static $dbh = null;
	
	public static function getDBH()
	{
		if (is_null(self::$dbh)) {
			try {
			    self::$dbh = new PDO('mysql:host='.DB_HOSTNAME.';dbname='.DB_DATABASE, DB_USERNAME, DB_PASSWORD);
			    self::$dbh->exec("set names utf8");
			} catch (PDOException $e) {
			    echo 'Connection failed: ' . $e->getMessage();
			    exit;
			}
		}
		return self::$dbh;
	}

}