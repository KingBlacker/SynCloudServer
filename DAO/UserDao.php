<?php
require_once '../DB/DbUtil.php';
date_default_timezone_set("Asia/Shanghai");

class UserDao{
	
	private $dbUtil = null;
	private $pdo = null;

	public function __construct(){
		$this->dbUtil = new DbUtil();
		$this->pdo = $this->dbUtil->connect();
	}

	public function testConn(){
		
		//insert test
		// $sql = "insert into user values('tom','12345')";
		// $this->pdo->beginTransaction();
		// $this->pdo->exec($sql);
	 	// $this->pdo->commit();

	    //query test
		$query = "select * from user";
        $res = $this->pdo->query($query);
		while($row = $res -> fetch()){
			print $row['UserName']."-".$row['UserPwd']."-".$row['RTime']."<br>";
		}
	}

	public function save($userName,$userPwd){
		try{
			$sql = "insert into user values(?,?,?)";
			//set the time format
			$rTime = date("Y-m-d h:i:s");
			//begin the transaction
			$this->pdo->beginTransaction();
			$stmt = $this->pdo->prepare($sql);
			
			$stmt->bindParam(1,$userName,PDO::PARAM_STR);
			$stmt->bindParam(2,$userPwd,PDO::PARAM_STR);
			$stmt->bindParam(3,$rTime,PDO::PARAM_STR);
			
			$stmt->execute();
			//there is no tips when occures the commit
			$this->pdo->commit();
			//show results
			//$this->testConn();
			//close the database
			$this->dbUtil->close();

		}catch(PDOException $e){
			echo date("Y-m-d h:i:s")." :Fail:".$e->getMessage();
		}
		} 
}
//main test
$userDao = new UserDao();
//$userDao->testConn();
$userDao->save('matrix','121550');
?>
