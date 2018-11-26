<? php

include_once 'db_credentials.php';
include_once 'utilityFunctions.php';

function createAccount($username, $password, $first, $last, $age, $gender, $country) {
	$connection = connectDB();
	
	$check_username = "SELECT * FROM UserInfo WHERE Username = '$username'";
	$insert = "INSERT INTO UserInfo (Username, Pass, First, Last, Age, Gender, Country)
		VALUES ('$username', '$password', '$first', '$last', '$age', '$gender', '$country')";
	
	if (($username_exists = checkExists($connection, $check_username)) > 0) {
		$message = "FAILUsername exists, please try again.";
		sendMessage($message, $sock);
	}
	else {
		if ($result = mysqli_query($connection, $insert)) {
			$message = "Success! User Account created.";
			sendMessage($message, $sock);
		}
	}
	disconnectDB($connection);
}

function loginAccount($username, $password, $sock) {
	$connection = connectDB();
	$check_username = "SELECT * FROM UserInfo Where Username = '$username'";
	$check_password = "SELECT * FROM UserInfo WHERE Username = '$username'";
	
	if (($username_exists = checkExists($connection, $check_username)) > 0) {
		if (($checkPass = checkExists($connection, $check_password)) > 0){
			$message = "Success! Account logged in.";
			sendMessage($message, $sock);
		}
	}
	disconnectDB($connection);
}

function logout($user) {
	$connection = connectDB();
	
	// do something
	
	disconnectDB($connection);
}
?>