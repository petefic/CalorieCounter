<?php include "base.php"; ?>
<?php session_start (); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Calorie Counter - Login</title>
<link href="oneColFixCtrHdr.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="container">

  <div class="header"><a href="#"><img src="logo.jpg" name="Insert_logo" width="180" height="90" id="Insert_logo" style="background: #C6D580; display:block;" /></a>
    <!-- end .header --></div>
    
  <div class="content">
    
<center>
<h1>Calculate your Health</h1>
<p>Please completely fill out the following fields and we will calculate your BMI and recommended calorie intake. This information will be saved in order to allow you to track your progess. <br>NOTE: you may calculate your information at any time, but progress is only saved once per month. Make sure you come back every month to enter your information again!"</p>

<form id="bmi" action="main.php" method="post">
<table>
<tr>
<td>
Height (in inches): </td><td><input type="text" id="height" name="height"></td>
</tr>
<tr>
<td>
Weight (in pounds): </td><td><input type="text" id="weight" name="weight"></td>
</tr>
<tr>
<td>
Age: </td><td><input type="text" id="age" name="age"></td>
</tr>
<tr>
<td>
Gender: </td><td><input type="text" id="gender" name="gender"></td>
</tr>
</table>
<input type="submit" value="Calculate" id="calcButton" name="calcButton"">

</form>


</center>



<?php

// if user filled out the entire form
if(!empty($_POST['height']) && !empty($_POST['weight']) && !empty($_POST['age']) && !empty($_POST['gender'])){
	
	// get info from form
	$height = $_POST["height"];
	$weight = $_POST["weight"];
	$age = $_POST["age"];
	$gender = $_POST["gender"];
	
	//calculate bmi
	$bmi = round(($weight/($height*$height)) * 703, 2);
	
	//determine recomended calorie intake and print results
	if($gender=="male"){
		if($bmi>23 && $bmi<25){
			$calories = round((66+(6.23*$weight)+(12.7*$height)-(6*$age)));
			$status="normal";
			echo "<p>Your BMI is: $bmi You are considered normal weight and should therefore consume: $calories calories per day. This calorie intake will ensure that you remain the same weight</p>";
		}
		else if ($bmi<23) {
			$calories = round((66+(6.23*$weight)+(12.7*$height)-(6*$age)+500));
			$status="underweight";
			echo "<p>Your BMI is: $bmi. You are considered under-weight, and should therefore consume: $calories calories a day. This calorie intake will cause you to gain one pound a week</p>";
		}
		else if ($bmi>25) {
			$calories=round((66+(6.23*$weight)+(12.7*$height)-(6*$age)-500));
			$status="overweight";
			echo "<p>Your BMI is: $bmi. You are considered over-weight and should therefore consume: $calories calories a day. This calorie intake will cause you to lose one pound a week</p>";
		}
	}
	else if($gender=="female"){
		if($bmi>18.49 && $bmi<24.9){
			$calories=round(655+(4.35*$weight)+(4.7*$height)-(4.7*$age));
			$status="normal";
			echo "<p>Your BMI is: $bmi. You are considered normal weight and should therefore consume: $calories calories a day. This calorie intake will ensure that you remain the same weight</p>";	
		}
		else if($bmi<18.49){
			$calories=round((655+(4.35*$weight)+(4.7*$height)-(4.7*$age)+500));
			$status="underweight";
			echo "<p>Your BMI is: $bmi. You are considered under-weight, and should therefore consume: $calories calories a day. This calorie intake will cause you to gain one pound a week</p>";
		}

		else if($bmi>24.9){	
			$calories=round((655+(4.35*$weight)+(4.7*$height)-(4.7*$age)-500));
			$status="overweight";
			echo "<p>Your BMI is: $bmi. You are considered over-weight and should therefore consume: $calories calories a day. This calorie intake will cause you to lose one pound a week</p>";
		}	
	}
	
	//get username and month
	$username = $_SESSION['Username'];
	$month = (int) date('m');
	
	//check if user has already entered information this month
	if(true){
		//add to db
		mysql_query("INSERT INTO info (user, weight, month) VALUES('".$username."', '".$weight."' ,'".$month."')");
		
		//print confirmation
		echo "<br><p>Your information was successfuly saved and is viewable on the Track Progress page</p>";
	}
	else{
		echo "<br><p>You have already saved your information this month, this data was not saved. Please come back on the first of next month</p>";	
	}
}
else {
	//print error message if user pressed button without filling every form
	if (isset($_POST['calcButton'])) { 
		echo "<p>ERROR: You must fill out every item</p>";	
	}
}

?>
  	
<br>
<center><a href="graphs.php">Click here to view your current progress</a></center>
    
    
    <!-- end .content --></div>
    
  <div class="footer">
	
	
	<center>
    <a href="faq.html">FAQ</a>
    <a href="logout.php">Log Out</a>
    </center>
  
    <!-- end .footer --></div>
    
  <!-- end .container --></div>
</body>
</html>
