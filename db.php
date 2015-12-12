<?php
	/*
	 * db.php connects to the MySQL database with username and password.
	 */
	
	// 1) Make the connection to the database, audiomax, with username and password.
	$connection = new mysqli("localhost", "root", "", "audiomax");
	if ($connection->connect_errno) {
    	echo "Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error;
	}
	// echo $connection->host_info . "\n";
?>