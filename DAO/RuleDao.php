<?php
require_once '../DB/DbUtil.php';
date_default_timezone_set("Asia/Shanghai");

class RuleDao{
	
	private $dbUtil = null;
	private $pdo = null;

	public function __construct(){
		$this->dbUtil = new DbUtil();
		$this->pdo = $this->dbUtil->connect();
	}
	
	/**
	 * test the database connection
	 * @return [null] [#]
	 */
	public function testConn(){
		$query = "select * from rule";
		$res = $this->pdo->query($query);
		while($row = $res->fetch()){
			print $row['IdFrom']."-".$row['IdTo']."<br>";	
		}
	}

	/**
	 * [save the information of the sync request]
	 * @param  [string] $idFrom    [#]
	 * @param  [string] $idTo      [#]
	 * @param  [string] $fileSrc   [the path of the source file]
	 * @param  [string] $startTime [#]
	 * @param  [string] $period    [#]
	 * @return [null]              [#]
	 */
	public function saveSrc($idFrom,$idTo,$fileSrc,$startTime,$period){
		try{
			$sql = "insert into rule(idfrom,idto,filesrc,starttime,period,ruleID) values(?,?,?,?,?,?)";
			$this->pdo->beginTransaction();
			$stmt = $this->pdo->prepare($sql);
			$ruleID = uniqid();
			$stmt->bindParam(1,$idFrom,PDO::PARAM_STR);
			$stmt->bindParam(2,$idTo,PDO::PARAM_STR);
			$stmt->bindParam(3,$fileSrc,PDO::PARAM_STR);
			$stmt->bindParam(4,$startTime,PDO::PARAM_STR);
			$stmt->bindParam(5,$period,PDO::PARAM_STR);
			$stmt->bindParam(6,$ruleID,PDO::PARAM_STR);
			
			$stmt->execute();
			$this->pdo->commit();
			
			$this->testConn();
			$this->dbUtil->close();
		}catch(PDOException $e){
			echo date("Y-m-d h:i:s").":Fail:".$e->getMessage();	
		}
	}

	/**
	 * [save the info of the dst file when the request is confirmed]
	 * @param  [type] $ruleID      [syncid to unique the action]
	 * @param  [type] $fileDst     [#]
	 * @param  [type] $isConfirmed [#]
	 * @return [type]              [#]
	 */
	public function saveDst($ruleID,$fileDst,$isConfirmed){
			try{
				$sql = "update rule set fileDst = ? , isConfirmed = ? where ruleID = ?";
				$this->pdo->beginTransaction();
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindParam(1,$fileDst,PDO::PARAM_STR);
				$stmt->bindParam(2,$isConfirmed,PDO::PARAM_INT);
				$stmt->bindParam(3,$ruleID,PDO::PARAM_STR);
				$stmt->execute();
				$this->pdo->commit();
				$this->testConn();
				$this->dbUtil->close();
			}catch(PDOException $e){
				echo date("Y-m-d h:i:s").":Fail: ".$e->getMessage();
			}
	}

	/**
	 * [save the sync time when sync is finished and set the time now()]
	 * @param  [type] $ruleID [#]
	 * @return [type]         [#]
	 */
	public function saveSyncTime($ruleID){
			try{
				$sql = "update rule set synctime = now() where ruleID = ?";
				$this->pdo->beginTransaction();
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindParam(1,$ruleID,PDO::PARAM_STR);
				$stmt->execute();
				$this->pdo->commit();
				$this->testConn();
				$this->dbUtil->close();
			}catch(PDOException $e){
				echo date("Y-m-d h:i:s").":Fail: ".$e->getMessage();
			}
	}
	
}
//main test
$ruleDao = new RuleDao();
//$ruleDao->saveSrc('001','002','C:/Windows','2015-07-27','every four days');
//$ruleDao->saveDst('55bae6f58dd39','D:/Movies',1);
$ruleDao->saveSyncTime('55bae6f58dd39');
?>
