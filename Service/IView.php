<?php
interface IView{
	public function getSyncFile($userId);
	public function getSyncUser($userId,$fileSrc);
}
?>