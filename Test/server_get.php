<?php
if ($_GET['username']) 
{
	$dt["username"] = $_GET['username'];
    	echo json_encode($dt);
}
?>