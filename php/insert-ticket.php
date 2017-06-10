<?php
    require("database/connect2DB.php");

	$id_user = $_REQUEST['id'];
	$bet_count = $_REQUEST['bet_count'];

    unset($stmt);
    $stmt =  $conn->stmt_init();
    $sql_query = "SELECT balanta FROM utilizatori WHERE id = '$id_user'";
    if($stmt =  $conn->prepare($sql_query)) {
        $stmt->bind_param("d", $id_user);
        $stmt->execute();
        $stmt->bind_result($balanta);
        $stmt->fetch();
    }

	if($balanta - $bet_count >= 0) {
		/* Inseram biletul in baza de date */
		unset($stmt);
		$stmt =  $conn->stmt_init();
		$sql_query = $_REQUEST['insert_ticket'];
		if($stmt =  $conn->prepare($sql_query))
			$stmt->execute();


		/* Facem update la balanta si biletele in asteptare */
		unset($stmt);
		$stmt =  $conn->stmt_init();

		$sql_query = "UPDATE utilizatori SET bilete_asteptare = bilete_asteptare + 1, bilete_total = bilete_total + 1, balanta = balanta - ? WHERE id = ?";
		if($stmt =  $conn->prepare($sql_query)) {
			$stmt->bind_param('ds', $bet_count, $id_user);
			$stmt->execute();
		}
	}
 ?>
