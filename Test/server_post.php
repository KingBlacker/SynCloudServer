<?php
	//set the time dafault
    date_default_timezone_set("Asia/Shanghai");

	//connect the database
	$conn = mysql_connect("localhost","root","");
	if(!$conn){
  		die('Could not connect: ' . mysql_error());
  	}

  	$dbName = "mydb";$tableName = "user";
  	mysql_select_db($dbName,$conn);

  	//get the data from client
   	$username = $_POST['username'];
   	$password = $_POST['password'];
  
	$query = "insert into ".$tableName." values('".$username."',".$password.",'".date('Y-m-d H:i:s',time())."');";
  $result = mysql_query($query,$conn);
  if(!$result){
      die("mysql error:".mysql_error());
  }
  $string = "add information successfully...";
  $resTips["tips"] = $string;
  //$dt["username"] = $_GET['username'];
  echo json_encode($resTips);
  //echo "add information to database sucessfullly!";
?>