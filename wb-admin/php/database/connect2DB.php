<?php
	require "db_connection.php";

	$conn = DbConnection::getDbConnection();
	if (!$conn) {
		echo "Can't connect to database...";
		exit();
	}
?>