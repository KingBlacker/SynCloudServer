<?php
require_once "../DB/DbUtil.php";
require_once "../Service/IView.php";
class ViewImpl implements IView{
	
	private $dbUtil = null;
	private $pdo = null;
	
	public function __construct(){
			$this->dbUtil = new DbUtil();
			$this->pdo = $this->dbUtil->connect();
	}
	/**
	 * [show all the files according to the userid]
	 * @param  [string] $userId [#]
	 * @return [null]         [#]
	 */
	public function getSyncFile($userId){
           try{
           	$this->pdo->beginTransaction();

			$sql = "select distinct filesrc
						 from (select idfrom,filesrc from rule where idfrom = ?)
						 		 as tmp;";
			
			$stmt = $this->pdo->prepare($sql);
		 	$stmt->execute(array($userId));
			$this->pdo->commit();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

				//use json to transfer the data
				print_r($row['filesrc']."<br>")."<br>";

			}
            $this->dbUtil->close();
           
           }catch(PDOException $e){
				echo date("Y-m-d h:i:s")."Failed: ".$e->getMessage();
           }
		}

	/**
	 * [get sync users according to the userid and the filesrc]
	 * @param  [type] $userId  [description]
	 * @param  [type] $fileSrc [description]
	 * @return [type]          [description]
	 */
	public function getSyncUser($userId,$fileSrc){
		 try{
           	$this->pdo->beginTransaction();

			$sql = "select filesrc,idto from rule where idfrom = ? and filesrc = ? ";
			
			$stmt = $this->pdo->prepare($sql);
		 	$stmt->execute(array($userId,$fileSrc));
			$this->pdo->commit();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				//use json to transfer the data
				print_r($row['filesrc']."-".$row['idto']."<br>");

			}
            $this->dbUtil->close();
           
           }catch(PDOException $e){
				echo date("Y-m-d h:i:s")."Failed: ".$e->getMessage();
           }
	}
}
//main test
$view = new ViewImpl();
//$view->getSyncFile('001');
//$view->getSyncUser('001','F:/Docs');
?>			

			
