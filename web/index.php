

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
				<p><label for="email">Email</label></p>
				<p><input type="text" name="email"></p>
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

 		require('../vendor/autoload.php');

 		$app = new Silex\Application();
		$app['debug'] = true;

		// Register the monolog logging service
		$app->register(new Silex\Provider\MonologServiceProvider(), array(
		  'monolog.logfile' => 'php://stderr',
		));

		// Our web handlers

		$app->get('/', function() use($app) {
		  $app['monolog']->addDebug('logging output.');
		  return 'Hello';
		});

		$app->run();

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