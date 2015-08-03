<?php
require_once 'DbConfig.php';
date_default_timezone_set("Asia/Shanghai");
/**
 * @description:utility of the database
 * @author matrix 2015/07/30 13:38
 * @version version 1.0
 * @copyright www.neoprint.cn
 */

class DbUtil {

 	private $pdo = null;
	/**
	 * @description connect the database
	 * @param null
	 * @return an object of the PDO
	 */
     public function connect() {
		$config = new DbConfig ();
		try {
			$pdo = new PDO ( $config->getDBNameHost (), $config->getDBUsr (), $config->getDBPwd () );
			// set attributes of the PDO
			$pdo->setAttribute ( PDO::ATTR_AUTOCOMMIT, false );
			$pdo->setAttribute ( PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true );
			$pdo->query ( "set names utf8" );
			
			echo date("Y-m-d h:i:s")." :connect to database successfully...<br>";
			return $pdo;
		} catch ( PDOException $e ) {
			echo date("Y-m-d h:i:s")." :Could not connect to the database:<br>.$e";
		}
	}
	
	
	/**
	 * @description close the database
	 * @param null
	 * @return null
	 */
	public function close() {
		try {
			if ($this->pdo) {
				$this->pdo = null;
			}
			echo date("Y-m-d h:i:s")." :close  database successfully...<br>";
		} catch ( PDOException $e ) {
			echo date("Y-m-d h:i:s")." :fail to close database...<br> . $e";
		}
	}
}
//main test
// $dbUtil = new DbUtil();
// $pdo = $dbUtil->connect();
// $dbUtil->close();

?>