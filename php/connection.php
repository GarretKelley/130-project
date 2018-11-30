<?php

include_once 'db_credentials.php';

function connectDB() {
	$connection = new mysqli(DB_Server, DB_User, DB_Pass, DB_Name);
	if ($connection->connect_error)
		die("Connection failed: " . $connection->connect_error);
	return $connection;
}

function disconnectDB($connection) {
	if($connection->close())
		echo "Database Closed \n";
}

?>