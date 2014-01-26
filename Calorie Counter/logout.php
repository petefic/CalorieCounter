<?php
	// log user out
	session_start();
	session_destroy();
	$_SESSION = array();
?>
<meta content="0;home.php" http-equiv="refresh">
