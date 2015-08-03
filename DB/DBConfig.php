<?php
/**
 * @description:configuration of the database
 * @author matrix 2015/07/30
 * @version version 1.0
 * @copyright www.neoprint.cn
 */


class DbConfig {

	private $dbNameHost = 'mysql:host=localhost;dbname=mydb';
	private $dbUsr = 'root';
	private $dbPwd = '';
	private $state = array (
			PDO::ATTR_PERSISTENT => TRUE 
	);
	
	/**
	 * @description configure the database
	 * @param $dbNameHost
	 * @param $dbUsr
	 * @param $dbPwd
	 * @param $state
	 * @return null
	 */
	public function _construct($dbNameHost, $dbUsr, $dbPwd, $state) {
		$this->dbNameHost = $dbNameHost;
		$this->dbUsr = $dbUsr;
		$this->dbPwd = $dbPwd;
		$this->state = $state;
	}
	
	
	public function getDBNameHost() {
		return $this->dbNameHost;
	}
	
	
	public function getDBUsr() {
		return $this->dbUsr;
	}
	
	
	public function getDBPwd() {
		return $this->dbPwd;
	}
}
?>
