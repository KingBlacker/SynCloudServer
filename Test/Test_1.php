<?php
try {
	$dbh = new PDO('mysql:host=localhost;dbname=mydb','root','');
	$dbh->query('set names utf8;');
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$dbh->beginTransaction();
	$dbh->exec("INSERT INTO user(username,userpwd) VALUES('mick', '22');");
	
	$dbh->commit();
}catch (Exception $e) {
	$dbh->rollBack();
	echo "Failed:".$e->getMessage();
}
?>