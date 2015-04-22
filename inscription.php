<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inscription.php</title>
</head>
<body>

    <div id="login">

        <?php

            // if (isset($_SESSION["first_name"]))
            // {
            //     echo '<h1>Hello, '.$_SESSION["first_name"].'</span> &nbsp <a href="index.php?logout"><span class="fa fa-power-off"></a></h1><br>';
            // }

        ?>

        <h2> Sign Up </h2>

        <fieldset>
        	<form name="inscription" action="inscription.php" onsubmit="return validate()" method="POST">
                <p><label>Username</label></p>
                <p><input type="text" name="username"><br></p>
                <p><label>Password</label></p>
                <p><input type="password" name="password1"><br></p>
                <p><label>Confirm password</label></p>
                <p><input type="password" name="password2"><br></p>
                <p><label>Email address</label></p>
                <p><input type="text" name="email"><br></p>

                <div id="button">
                    <input type="submit" value="Sign Up">
                    <input type="button" value="Cancel" onclick="window.location.href='index.php';">
                </div>
        	</form>
        </fieldset>

    </div>

	<?php

		if (isset($_POST["username"])	 && isset($_POST["password1"]) && isset($_POST["email"]))
		{

			$username = $_POST["username"];
			
			$password1 = $_POST["password1"];
			$password2 = $_POST["password2"];
			$email = $_POST["email"];

            $cnx = mysql_connect("localhost:8889", "root", "root");
            $db = mysql_select_db("ucanada");

            $sql = mysql_query("SELECT * FROM utilisateur WHERE pseudo='$username'");

            if (mysql_num_rows($sql) > 0) 
            {
                echo '<script>alert("Username already exist.");</script>';
            }
            else 
            {
                $sql = "INSERT INTO utilisateur (pseudo, motdepasse, email) VALUES ('$username', '$password1', '$email')";
                $request = mysql_query($sql, $cnx) or die (mysql_error());

                echo '<script>window.location.href="index.php"</script>';
            }
		}
	?>
    
	<script type="text/javascript">

	function validate()
	{
		isValid = true;
		message = "";

		    var x = document.forms["inscription"]["username"].value;
            if (x == null || x == "" || x.length < 3) 
            {
                isValid = false;
                message += "- Username must be 3 character minimum. \n";
            }
           
            

            var x = document.forms["inscription"]["password1"].value;
            if (x == null || x == "" || x.length < 3) 
            {
                isValid = false;
                message += "- Password must be 3 character minimum. \n";
            }

            var x1 = document.forms["inscription"]["password1"].value;
            var x2 = document.forms["inscription"]["password2"].value;
            if (x1 != x2 )
            {
                isValid = false;
                message += "- Password does not match. \n";
            }

            var x = document.forms["inscription"]["email"].value;
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");
            if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) 
            {
                isValid = false;
                message += "- Invalid email. \n";
            }

            if (isValid == false)
            {
                alert(message);
                return isValid;
            }
            else 
            {
                return isValid;
            }
        }
	</script>
</body>

</html>