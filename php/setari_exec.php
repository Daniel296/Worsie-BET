<?php
session_start();

if(isset($_POST['flag'])) {
	$flag = $_POST['flag'];
	switch ($flag) {
		case 1:
			updateInfo($_SESSION['id']);
			break;
		
		case 2:
			updatePassword($_SESSION['id']);
			break;

		case 3:
			updateEmail($_SESSION['id']);
			break;

	}
}


/* #################### ###################### #################### */
/* ###################### updateInfo(userID) ###################### */
/* #################### ###################### #################### */
function updateInfo($uID) {
	require "database/connect2DB.php";

    $nume = $_POST["firstname"];
    $prenume = $_POST["lastname"];
    $judet = $_POST["county"];
    $oras = $_POST["city"];
    $adresa = $_POST["address"];
    $telefon = $_POST["phone"];

    $sql = "UPDATE `UTILIZATORI` SET `nume`=?, `prenume`=?, `judet`=?, `oras`=?, `adresa`=?, `telefon`=? WHERE `ID`=?";
	    
	if($stmt =  $conn->prepare($sql)) {
		$stmt->bind_param('ssssssd', $nume, $prenume, $judet, $oras, $adresa, $telefon, $uID);
		$stmt->execute();
	}
	//header('Location: profile.php?page=setari&setat=1');
}



/* #################### ###################### #################### */
/* #################### updatePassword(userID) #################### */
/* #################### ###################### #################### */
function updatePassword($uID) {
	require "database/connect2DB.php";

	$current_password = $_POST['current_password'];
	$new_password = $_POST['new_password'];
	$confirm_password = $_POST['confirm_password'];

	$sql = "UPDATE `utilizatori` SET `parola`=? WHERE `ID`=?";

	if($stmt =  $conn->prepare($sql)) { //
		$stmt->bind_param('sd', $new_password, $uID);
		$stmt->execute();
	}
}



/* #################### ###################### #################### */
/* ###################### updateEmail(userID) ##################### */
/* #################### ###################### #################### */
function updateEmail($uID) {
	require "database/connect2DB.php";

	$current_email = $_POST['current_email'];
	$new_email = $_POST['new_email'];

	$sql = "UPDATE `utilizatori` SET `email`=? WHERE `ID`=?";

	if($stmt =  $conn->prepare($sql)) { //
		$stmt->bind_param('sd', $new_email, $uID);
		$stmt->execute();
		echo "Email'ul a fost modificat cu succes.";
	} else
		echo "Email'ul nu a putut fi modificat.";
}

?>