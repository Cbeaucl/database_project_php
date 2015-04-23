<?php

	session_start();

	$cnx = mysql_connect("localhost:3306", "root", "1");
    $db = mysql_select_db("ucanada");

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
			
				header("Location: display.php");
			}
			else{
				header("Location: search.php");
			}
		}
		else
		{
			header("Location: inscription.php");
		}
	}
	else
	{
		header("Location: index.php?empty");
	}
?>