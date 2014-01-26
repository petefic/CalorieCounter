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
if(!empty($_POST['username']) && !empty($_POST['password']))
{
	// clean and encrypt user's inputted username and password
	$username = mysql_real_escape_string($_POST['username']);
    $password = md5(mysql_real_escape_string($_POST['password']));
    
	//search db for username
	$checkusername = mysql_query("SELECT * FROM users WHERE Username = '".$username."'");
     
	 //if username already registered
     if(mysql_num_rows($checkusername) == 1)
     {
     	echo "<h1>Error</h1>";
        echo "<p>Sorry, that username is taken. Please go back and try again.</p>";
     }
     else
     {
     	//add user's info to db
		$registerquery = mysql_query("INSERT INTO users (Username, Password) VALUES('".$username."', '".$password."')");
        //check if info was added successfully
		if($registerquery)
        {
        	echo "<h1>Success</h1>";
        	echo "<p>Your account was successfully created. Please <a href=\"home.php\">click here to login</a>.</p>";
        }
        else
        {
     		echo "<h1>Error</h1>";
        	echo "<p>Sorry, your registration failed. Please go back and try again.</p>";    
        }    	
     }
}
else
{
	?>
    
   <h1>Register</h1>
    
   <p>Please enter your details below to register.</p>
    
	<form method="post" action="register.php" name="registerform" id="registerform">
	<fieldset>
		<label for="username">Username:</label><input type="text" name="username" id="username" /><br />
		<label for="password">Password:</label><input type="password" name="password" id="password" /><br />
		<input type="submit" name="register" id="register" value="Register" />
	</fieldset>
	</form>
    
    <?php
}
?>
  
    
    <!-- end .content --></div>
    
  <div class="footer">
    <!-- end .footer --></div>
    
  <!-- end .container --></div>
</body>
</html>
