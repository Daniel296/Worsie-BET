<?php
    require("database/connect2DB.php");

	/* Inseram biletul in baza de date */
	unset($stmt);
	$stmt =  $conn->stmt_init();
	$sql_query = $_REQUEST['insert_ticket'];
	if($stmt =  $conn->prepare($sql_query))
		$stmt->execute();

	$id_user = $_REQUEST['id'];
	$bet_count = $_REQUEST['bet_count'];

    /* Facem update la balanta si biletele in asteptare */
	unset($stmt);
	$stmt =  $conn->stmt_init();
	$sql_query = "UPDATE utilizatori SET bilete_asteptare = bilete_asteptare + 1, balanta = balanta - ? WHERE id = ?";
	if($stmt =  $conn->prepare($sql_query)) {
		$stmt->bind_param('ds', $bet_count, $id_user);
		$stmt->execute();
	}
 ?>
