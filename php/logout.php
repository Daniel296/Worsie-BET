<?php
	require("../php/database/connect2DB.php");
	session_start();
	session_destroy();
	$stmt =  $conn->stmt_init();
	$sql_query = "UPDATE UTILIZATORI SET conectat = 0 WHERE id = ?";
	if($stmt =  $conn->prepare($sql_query)) {
		$stmt->bind_param('d', $_SESSION['id']);
		$stmt->execute();
		if($conn->affected_rows == 0)
			echo "Update error";
	}
	else {
		echo "Logout update error!<br>";
	}
	unset($_SESSION['id']);
	header('Location: ../index.php');
?>
