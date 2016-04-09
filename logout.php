<?php
if($_REQUEST["id"])
	{
		$id = $_REQUEST["id"];
		$pass = $_REQUEST["pass"];
		$servername = "localhost";
		$username = "root";
		$password = "";
		$db = "chatall";
		$conn = mysqli_connect($servername, $username, $password,$db);
		if(mysqli_connect_error()) 
		{
    	die("Database connection failed: " . mysqli_connect_error());
		}
		$sql = "update users set status = 0 where username = '$id'";
		$rslt = mysqli_query($conn,$sql);
		session_unset();
		session_destroy();
		echo "true";	
	}
else
 	echo "server busy!!!";
?>