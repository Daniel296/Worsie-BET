<!DOCTYPE HTML>
<html>
<head>
	<title>TOP PARIORI - WorsieBET</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-header.css">
	<link rel="stylesheet" type="text/css" href="css/tables.css">
</head>
<body>

<?php
	require('pages/header.php');
?>

<h2>Top pariori</h2>

<?php
	$connection = mysqli_connect('localhost', 'root', '', 'worsiebet');
	$res = mysqli_query($connection,"SELECT username, email, nume, prenume, bilete_total, bilete_castigate FROM utilizatori WHERE bilete_castigate<>0 ORDER BY bilete_total/bilete_castigate");
	if($res === FALSE) { 
		die(mysql_error()); // TODO: better error handling
	}
	echo "<table align=\"center\">";
	echo "<tr>";
	echo	"<th>Username</th>";
	echo	"<th>Email</th>";
	echo	"<th>Nume</th>";
	echo	"<th>Prenume</th>";
	echo	"<th>Bilete total</th>";
	echo	"<th>Bilete câștigate</th>";
    echo	"</tr>";
	while ($row = $res->fetch_assoc()) {
		echo "<tr>";
        echo "<td>";
		echo $row['username'];
		echo "</td>";
		echo "<td>";
		echo $row['email'];
		echo "</td>";
		echo "<td>";
		echo $row['nume'];
		echo "</td>";
		echo "<td>";
		echo $row['prenume'];
		echo "</td>";
		echo "<td>";
		echo $row['bilete_total'];
		echo "</td>";
		echo "<td>";
		echo $row['bilete_castigate'];
		echo "</td>";
        echo "</tr>";
	}
	echo "</table>";
?>

<?php
	require('pages/footer.php');
?>


</body>
</html>
