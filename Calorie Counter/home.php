<?php include "base.php"; ?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Calorie Counter - Logint</title>
<link href="oneColFixCtrHdr.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="container">

  <div class="header"><a href="#"><img src="logo.jpg" name="Insert_logo" width="180" height="90" id="Insert_logo" style="background: #C6D580; display:block;" /></a>
    <!-- end .header --></div>
    
  <div class="content">
    
  <?php
//if user is already logged in redirect them to the main page
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
	 ?>
     
     <meta http-equiv="refresh" content="0; url=main.php"> 
	 
	 <?php
}
//if user has tried to login
elseif(!empty($_POST['username']) && !empty($_POST['password']))
{
	//real_escape_string cleans the input as a security measure
	$username = mysql_real_escape_string($_POST['username']);
	//md5 encrypts the password
    $password = md5(mysql_real_escape_string($_POST['password']));
    
	//search db for the username and password
	$checklogin = mysql_query("SELECT * FROM users WHERE Username = '".$username."' AND Password = '".$password."'");
    
	//if username and password found, log in the user
    if(mysql_num_rows($checklogin) == 1)
    {
    	$row = mysql_fetch_array($checklogin);
        
        $_SESSION['Username'] = $username;
        $_SESSION['LoggedIn'] = 1;
        
    	echo "<h1>Success</h1>";
        echo "<p>We are now redirecting you to the member area.</p>";
		?>
        
        <meta http-equiv="refresh" content="0; url=main.php"> 
        
        <?php
    }
	// user typed in incorrect login information
    else
    {
    	echo "<h1>Error</h1>";
        echo "<p>Sorry, your account could not be found. Please <a href=\"home.php\">click here to try again</a>.</p>";
    }
}
// display login screen
else
{
	?>
    
   <center>
   <h1>Welcome</h1>
    
   <p>Thanks for visiting! Calorie Counter is a website that allows you to calculate your BMI, find your recommended calorie intake, and track your weightloss progress. You must have a user account to use Calorie Counter. Please either login below to start getting healthy!</p>
    
	<form method="post" action="home.php" name="loginform" id="loginform">
	<fieldset>
    	<legend>Login</legend>
		<label for="username">Username:</label><input type="text" name="username" id="username" /><br />
		<label for="password">Password:</label><input type="password" name="password" id="password" /><br />
		<input type="submit" name="login" id="login" value="Login" />
	</fieldset>
	</form>
    </center>
    
    <br>
    <p>Or if you do not already have an account <a href="register.php">click here to register</a></p>
    
   <?php
}
?>

  
    
    <!-- end .content --></div>
    
  <div class="footer">
    <!-- end .footer --></div>
    
  <!-- end .container --></div>
</body>
</html>
