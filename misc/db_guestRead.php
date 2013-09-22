<?php
// Create connection with db
	$mysqlhost = 'homemadewater.nl';
	$user = 'juliuqb30_HWsite';
	$passwd = 'Jelam';
	$db = 'juliuqb30_hw2';

	$mysql = mysqli_connect($mysqlhost,$user, $passwd, $db);
	if (!$mysql) {
		die('Could not connect: ' . mysql_error());
	}
?>
