<?php
if($_REQUEST["id"] && $_REQUEST["pass"])
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
		$sql = "select * from users where username = '$id' and password = '$pass' ";
		$rslt = mysqli_query($conn,$sql);
		if(mysqli_num_rows($rslt) == 1) 
			{
				session_start();
				$_SESSION["id"] = $id;
				echo "true";
			}
		else
			echo "wrong username or password!";	
	}
else
 	echo "server busy!!!";
?>