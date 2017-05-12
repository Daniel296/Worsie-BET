<?php


$option = 0;
if(isset($_POST['nume']) && isset($_POST['prenume']) && isset($_POST['judet']) && isset($_POST['oras']) && isset($_POST['adresa']) && isset($_POST['telefon'])) {
	//echo $_POST['nume'] . "<br>" . $_POST['prenume'] . "<br>" . $_POST['judet'] . "<br>" . $_POST['oras'] . "<br>" . $_POST['adresa'] . "<br>" . $_POST['telefon'];
	updateInfo($_SESSION['user_ID']);
	$option = 1;
}
else if(isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
	//echo $_POST['current_password'] . "<br>" . $_POST['new_password'] . "<br>" . $_POST['confirm_password'];
	updatePassword($_SESSION['user_ID']);
	$option = 2;
}
else if(isset($_POST['current_email']) && isset($_POST['new_email'])) {
	//echo $_POST['current_email'] . "<br>" . $_POST['new_email'];
	updateEmail($_SESSION['user_ID']);
	$option = 3;
}


/* #################### ###################### #################### */
/* ###################### updateInfo(userID) ###################### */
/* #################### ###################### #################### */
function updateInfo($x) {
	require "../php/database/connect2DB.php";

    $nume = $_POST["nume"];
    $prenume = $_POST["prenume"];
    $judet = $_POST["judet"];
    $oras = $_POST["oras"];
    $adresa = $_POST["adresa"];
    $telefon = $_POST["telefon"];

    $stmt =  $conn->prepare("UPDATE `UTILIZATORI` SET `nume`=?, `prenume`=?, `judet`=?, `oras`=?, `adresa`=?, `telefon`=? WHERE `ID`=?");
    $stmt->bind_param(1, $nume, PDO::PARAM_STR);
    $stmt->bind_param(2, $prenume, PDO::PARAM_STR);
    $stmt->bind_param(3, $judet, PDO::PARAM_STR);
    $stmt->bind_param(4, $oras, PDO::PARAM_STR);
    $stmt->bind_param(5, $adresa, PDO::PARAM_STR);
    $stmt->bind_param(6, $telefon, PDO::PARAM_STR);
    $stmt->bind_param(7, $x, PDO::PARAM_INT);

    $stmt->execute();
}


/* #################### ###################### #################### */
/* #################### updatePassword(userID) #################### */
/* #################### ###################### #################### */
function updatePassword($x) {
	require "../php/database/connect2DB.php";	

	$current_password = $_POST['current_password'];
	$new_password = $_POST['new_password'];
	$confirm_password = $_POST['confirm_password'];

	if($new_password == $confirm_password) {
		$stmt = $conn->prepare("UPDATE `UTILIZATORI` SET `parola`=? WHERE `ID`=?");
		$stmt->bind_param(1, $new_password, PDO::PARAM_STR);
		$stmt->bind_param(2, $x, PDO::PARAM_INT);

		$stmt->execute();
	} else {

	}
}



/* #################### ###################### #################### */
/* ###################### updateEmail(userID) ##################### */
/* #################### ###################### #################### */
function updateEmail($x) {
	require "../php/database/connect2DB.php";

	$current_email = $_POST['current_email'];
	$new_email = $_POST['new_email'];

	if($current_email != $new_email) {
		$stmt = $conn->prepare("UPDATE `UTILIZATORI` SET `email`=? WHERE `ID`=?");
		$stmt->bind_param(1, $new_email, PDO::PARAM_STR);
		$stmt->bind_param(2, $x, PDO::PARAM_INT);

		$stmt->execute();
	} else {

	}
}

echo "<br><br>" . $option;
?>