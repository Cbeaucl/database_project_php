

<!DOCTYPE html>
<html>
<head>
  <title>Ucanada Login Tool</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
	<div id="login">
		<h2 Sign In</h2>
		<form class="form-horizontal" action="login.php" method="POST">
			<fieldset>
				<p><label for="username">Username</label></p>
				<p><input type="text" name="username"></p>
				<p><label for="password">Password</label></p>
				<p><input type="password" name="password"></p>
				<div id="button">
					<input type="submit" name="connection" value="Sign In">
					<p>Not a member? <a href="inscription.php">Sign Up.</a></p>
				</div>
			</fieldset>
		</form>
	</div>

 	<?php

		if (isset($_GET["empty"]))
		{
			echo '<script type="text/javascript">alert("Invalid username or password.")</script>';
		}

		else if (isset($_GET["logout"]))
		{
			session_start();
			session_destroy();
			session_unset();
		}

	?>

</body>

</html>