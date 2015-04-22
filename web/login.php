<?php

	session_start();

	$cnx = mysql_connect("ec2-54-197-250-40.compute-1.amazonaws.com:5432", "kndudxvctgholn", "2MaLR66M73nM-MvKkoPbXcbC_m", true,  MYSQL_CLIENT_SSL);
	$db = mysql_select_db("dc5ft6pilej1ng");

	$email = $_POST["email"];
	$password = $_POST["password"];
	
	if ($email != "" && $password != "")
	{
		$sql = "SELECT * FROM member WHERE email='$email'";
		$request = mysql_query($sql, $cnx);
		$result = mysql_fetch_object($request);

		$db_password = $result->password;
		$role = $result->role;

		if ($db_password == $password)
		{
			$_SESSION["role"] = $role;
			$_SESSION["email"] = $email;
			if ($role == "admin"){
			
				header("location: display.php");
			}
			else{
				header("location: search.php");
			}
		}
		else
		{
			header("location: inscription.php");
		}
	}
	else
	{
		header("location: index.php?empty");
	}
?>