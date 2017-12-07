<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="keywords" content="">

</head>

<body>
	<?php
	if(isset($_POST['login'])){
		if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  // Captcha verification is incorrect.
			echo "The Validation code does not match!</span>"
			. "<p>Redirecting to the <a href=\"page-login.php\">Login</a> page.</p>";		
		}
		else{// Captcha verification is Correct. Final Code Execute here!		

			$isLoginSuccess=0;
			$accName=$_POST["inputAC"];
			$pw=$_POST["inputPw"];
  			require_once('connection/conn.php');

			$query = "SELECT * FROM `Customers` WHERE accountName='$accName' and pw='$pw'";
			$result = mysql_query($query) or die(mysql_error($conn));
			$count = mysql_num_rows($result);
			if ($count == 1){
				$_SESSION['accountName'] = $accName;
	  			echo "<h1>Login successfully!</h1>"
      				. "<p>Redirecting to the <a href=\"shop-index.php\">HOME</a> page.</p>";
			}
			else{
				echo "Invalid Login Credentials.";
			}
			mysql_close($conn);
		}
	}
	?>
</body>
</html>