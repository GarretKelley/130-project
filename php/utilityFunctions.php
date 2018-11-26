<? php

include_once 'db_credentials.php';

function checkExistsDB($connection, $query) {
	if ($stmt = mysqli_prepare($connection, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		$exists = mysqli_stmt_num_rows($stmt);
		mysqli_stmt_close($stmt);
		return $exists;
	}
}

function sendMessage($message, $socket) {
	$messageSize = str_pad((string)strlen($message), 5, "0", STR_PAD_LEFT);
	$code = substr($message, 0, 4);
	fwrite($socket, "{$messageSize}{$message}");
}

?>