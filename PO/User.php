<?php
class User{
	public function __construct($userName,$userPwd){
		$this->userName = $userName;
		$this->userPwd = $userPwd;
	}
	public function setUserName($userName){
		$this->userName = $userName;
	}
	public function setUserPwd($userPwd){
		$this->userPwd = $userPwd;
	}
	public function getUserName(){
		return $this->userName;
	}
	public function getUserPwd(){
		return $this->userPwd;	
	}
}
?>
