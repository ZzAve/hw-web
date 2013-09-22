<?php
// Create connection with db
	$mysqlhost = 'homemadewater.nl';
	$user = 'juliuqb30_hw2';
	$passwd = 'oj1WR0fH';
	$db = 'juliuqb30_hw2';
	
	if(isset($mysql)){
		mysqli_close($mysql);
	}

	$mysql = mysqli_connect($mysqlhost,$user, $passwd, $db);
	if (!$mysql) {
		die('Could not connect: ' . mysql_error());
	}
?>
