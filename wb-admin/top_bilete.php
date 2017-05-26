<!DOCTYPE HTML>
<html>
<head>
<style>
	h2 {
		text-align:center;
		color:white;
	}

	table {
		border-collapse: collapse;
		width: 65%;
	}

	th, td {
		text-align: center;
		padding: 8px;
		color: #fff;
	}

	tr:nth-child(even){
		background-color: #670011;
	}

	th {
		background-color: #4CAF50;
		color: white;
	}
</style>
	<title>TOP BILETE - WorsieBET</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-header.css">
</head>
<body>

<?php
	require('pages/header.php');
?>

	<h2>Top bilete pariate</h2>

<?php
	$connection = mysqli_connect('localhost', 'root', '', 'worsiebet');
	$res = mysqli_query($connection,"SELECT suma_depusa, suma_castig, cod, cota, data_creare FROM bilete ORDER BY suma_castig DESC");
	if($res === FALSE) { 
		die(mysql_error()); // TODO: better error handling
	}
	echo "<table align=\"center\">";
	echo "<tr>";
	echo	"<th>Sumă câștig</th>";
	echo	"<th>Sumă depusă</th>";
	echo	"<th>Cod bilet</th>";
	echo	"<th>Cotă totală</th>";
	echo	"<th>Dată creare</th>";
    echo	"</tr>";
	while ($row = $res->fetch_assoc()) {
		echo "<tr>";
        echo "<td>";
		echo $row['suma_castig'];
		echo "</td>";
		echo "<td>";
		echo $row['suma_depusa'];
		echo "</td>";
		echo "<td>";
		echo $row['cod'];
		echo "</td>";
		echo "<td>";
		echo $row['cota'];
		echo "</td>";
		echo "<td>";
		echo $row['data_creare'];
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
