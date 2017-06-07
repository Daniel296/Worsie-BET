<?php

$option = 0;
if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['county']) && isset($_POST['city']) && isset($_POST['address']) && isset($_POST['phone'])) {
	//echo $_POST['nume'] . "<br>" . $_POST['prenume'] . "<br>" . $_POST['judet'] . "<br>" . $_POST['oras'] . "<br>" . $_POST['adresa'] . "<br>" . $_POST['telefon'];
	updateInfo(1);//$_SESSION['user_ID']);
	$option = 1;
}
else if(isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
	//echo $_POST['current_password'] . "<br>" . $_POST['new_password'] . "<br>" . $_POST['confirm_password'];
	updatePassword(1);//$_SESSION['user_ID']);
	$option = 2;
}
else if(isset($_POST['current_email']) && isset($_POST['new_email'])) {
	//echo $_POST['current_email'] . "<br>" . $_POST['new_email'];
	updateEmail(1);//$_SESSION['user_ID']);
	$option = 3;
}


/* #################### ###################### #################### */
/* ###################### updateInfo(userID) ###################### */
/* #################### ###################### #################### */
function updateInfo($x) {
	require "database/connect2DB.php";

    $nume = $_POST["firstname"];
    $prenume = $_POST["lastname"];
    $judet = $_POST["county"];
    $oras = $_POST["city"];
    $adresa = $_POST["address"];
    $telefon = $_POST["phone"];

/*
    if(!ctype_alnum($nume))
    	header('Location: ../profile.php?page=setari&err=111#cont');
    if(!ctype_alnum($prenume))
    	header('Location: ../profile.php?page=setari&err=121#cont');
    if(!ctype_alnum($judet))
    	header('Location: ../profile.php?page=setari&err=131#cont');
    if(!ctype_alnum($oras))
    	header('Location: ../profile.php?page=setari&err=141#cont');
    if(!ctype_alnum($adresa))
    	header('Location: ../profile.php?page=setari&err=151#cont');
    if(!ctype_alnum($telefon))
    	header('Location: ../profile.php?page=setari&err=161#cont');
*/
    $sql = "UPDATE `UTILIZATORI` SET `nume`=?, `prenume`=?, `judet`=?, `oras`=?, `adresa`=?, `telefon`=? WHERE `ID`=?";
	    
	if($stmt =  $conn->prepare($sql)) {
		$stmt->bind_param('ssssssd', $nume, $prenume, $judet, $oras, $adresa, $telefon, $x);
		$stmt->execute();
	} else header('Location: ../profile.php?page=setari');
}


/* #################### ###################### #################### */
/* #################### updatePassword(userID) #################### */
/* #################### ###################### #################### */
function updatePassword($x) {
	require "database/connect2DB.php";//require "../php/database/connect2DB.php";	

	$current_password = $_POST['current_password'];
	$new_password = $_POST['new_password'];
	$confirm_password = $_POST['confirm_password'];


	/* Parola actuala coincide cu noua parola ?*/
	if($new_password == $current_password) {
		header('Location: ../profile.php?page=setari&err=211#password');
	}


	/* Parola noua coincide cu parola confirmata? */
	if($new_password != $confirm_password) {
		header('Location: ../profile.php?page=setari&err=221#password');
	} else {
		$sql = "UPDATE `utilizatori` SET `parola`=? WHERE `ID`=?";

		if($stmt =  $conn->prepare($sql)) { //
			$stmt->bind_param('sd', $new_password, $x);
			$stmt->execute();
		} else header('Location: ../profile.php?page=setari');
	}
}



/* #################### ###################### #################### */
/* ###################### updateEmail(userID) ##################### */
/* #################### ###################### #################### */
function updateEmail($x) {
	require "database/connect2DB.php";

	$current_email = $_POST['current_email'];
	$new_email = $_POST['new_email'];

	if(!ctype_alnum($current_email) || !ctype_alnum($new_email)) {
    	header('Location: ../profile.php?page=setari&err=311#email');
    }
	
	/* E-mail'ul curent coincide cu e'mail vechi? */
	if($current_email == $new_email) {
		header('Location: ../profile.php?page=setari&err=321#email');
	} else {

		$sql = "UPDATE `utilizatori` SET `email`=? WHERE `ID`=?";

		if($stmt =  $conn->prepare($sql)) { //
			$stmt->bind_param('sd', $new_email, $x);
			$stmt->execute();

		} else header('Location: ../profile.php?page=setari');
	}
}

?>