<?php
interface ILoginReg{
	public function login($userName,$userPwd);
	public function register($userName,$userPwd);
}
?>