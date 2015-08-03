<?php

require_once "../Service/ILoginReg.php";
require_once "../DAO/UserDao.php";

class LoginRegImpl implements ILoginReg{
		
		private $userDao = null;
		private $dbUtil = null;
		private $pdo = null;

		public function __construct(){
			$this->userDao = new UserDao();
			$this->dbUtil = new DbUtil();
			$this->pdo = $this->dbUtil->connect();
		}
		public function login($userName,$userPwd){
				try{
					$this->pdo->beginTransaction();
					$sql = "select count(*) as count from user where username = ? and userpwd = ?";
				    $stmt = $this->pdo->prepare($sql);
					
					//why this can not work well?
					//
					// $stmt->bindParam(1,$uerName,PDO::PARAM_STR);
					// $stmt->bindParam(2,$userPwd,PDO::PARAM_STR);
				    
				    $stmt->execute(array($userName,$userPwd));
					$this->pdo->commit();
					
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						   if($row['count'] == 1){
								$result = 'login successfully...!<br>';
							}else{
								$result = 'no match for you...!<br>';
							}
					}
                    $this->dbUtil->close();
					return $result;
				}catch(PDOException $e){
					echo date("Y-m-d h:i:s").":Failed: ".$e->getMessage();
				}
			
		}
		public function register($userName,$userPwd){
			   $this->userDao->save($userName,$userPwd);
		}
}
//main test
$lr = new LoginRegImpl();
//echo $lr->login('matrix','1214');
//$lr->register('zhp','1991');
?>