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

    $nume = $_POST["lastname"];
    $prenume = $_POST["firstname"];
    $judet = $_POST["county"];
    $oras = $_POST["city"];
    $adresa = $_POST["address"];
    $telefon = $_POST["phone"];

    $sql = "UPDATE `UTILIZATORI` SET `nume`=?, `prenume`=?, `judet`=?, `oras`=?, `adresa`=?, `telefon`=? WHERE `ID`=?";
	    
	if($stmt =  $conn->prepare($sql)) {
		$stmt->bind_param('ssssssd', $nume, $prenume, $judet, $oras, $adresa, $telefon, $uID);
		$stmt->execute();
		echo "0";
	} else echo "1";
}



/* #################### ###################### #################### */
/* #################### updatePassword(userID) #################### */
/* #################### ###################### #################### */
function updatePassword($uID) {
	require "database/connect2DB.php";

	$current_password = $_POST['current_password'];
	$new_password = $_POST['new_password'];
	//$confirm_password = $_POST['confirm_password'];
	$hash_password = password_hash(trim($new_password), PASSWORD_BCRYPT);

	$sql = "UPDATE `utilizatori` SET `parola`=? WHERE `ID`=?";

	if($stmt =  $conn->prepare($sql)) {
		$stmt->bind_param('sd', $hash_password, $uID);
		$stmt->execute();
		echo "0";
	} else echo "1";
}



/* #################### ###################### #################### */
/* ###################### updateEmail(userID) ##################### */
/* #################### ###################### #################### */
function updateEmail($uID) {
	require "database/connect2DB.php";

	$current_email = $_POST['current_email'];
	$new_email = $_POST['new_email'];

	$sql = "UPDATE `utilizatori` SET `email`=? WHERE `email`=?";

	if($stmt =  $conn->prepare($sql)) { //
		$stmt->bind_param('ss', $new_email, $current_email);
		$stmt->execute();
		echo "0";
	} else
		echo "1";
}

?>