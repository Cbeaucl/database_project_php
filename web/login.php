<?php

	session_start();

	$cnx = mysql_connect("localhost:8889", "root", "root");
	$db = mysql_select_db("ucanada");

	$username = $_POST["username"];
	$password = $_POST["password"];
	
	if ($username != "" && $password != "")
	{
		$sql = "SELECT * FROM utilisateur WHERE pseudo='$username'";
		$request = mysql_query($sql, $cnx);
		$result = mysql_fetch_object($request);

		$db_password = $result->motdepasse;

		if ($db_password == $password)
		{
			$_SESSION["username"] = $username;
			if ($username == "admin"){
			
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