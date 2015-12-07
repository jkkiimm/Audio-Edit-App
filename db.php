<?php
	$connection = new mysqli("localhost", "root", "audiomax411", "audiomax");
	if ($connection->connect_errno) {
    	echo "Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error;
	}
	// echo $connection->host_info . "\n";
?>
