<!DOCTYPE HTML>
<html>
<head>
	<title>Rezultate - WorsieBet</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-header.css">
	<link rel="stylesheet" type="text/css" href="css/popup-style.css">
</head>

<body>

<?php
	require('pages/header.php');
	require('php/rezultate_pariuri.php');

	$location = "";
	if(isset($_GET['date'])) {
		$data_cautare = $_GET['date'];
	}
	else {
		$data_cautare = date("Y-m-d", time());
		$location = "Location: ./rezultate.php?date=" . $data_cautare;
		if(isset($_GET['race']))
			$location .= ("&race=" . $_GET['race']);
	}

	if($data_cautare > date("Y-m-d", time()))
		header('Location: ./rezultate.php');

?>

<div id="main-results">

	<div id="search" class="search-bar">
		<form  method="GET" action="#res">
			<input type="hidden" name="date" value="<?php echo $data_cautare ?>"/>
			<input name="race" placeholder="Căutare...">
			<div class="search-img">
				<button type="submit"><img src="images/search.png" alt="search"></button>
			</div>
		</form>
	</div>


	<div class="show-bets-day">
		<ul>
			<?php
				$get_date = "";
				if(isset($_GET['date']))
					$get_date = $_GET['date'];
				else
					$get_date = date("Y-m-d", time());

				$num_day = getdate();
				$days = array(0 => "Luni", 1 => "Mar&#355i", 2 => "Miercuri", 3 => "Joi", 4 => "Vineri", 5 => "Sâmbătă", 6 => "Duminică");

				$day = date("Y-m-d", time() - 4 * 86400);
				if($get_date == $day)
					echo "<li class=\"active\"><a href =\"rezultate.php?date=$day\">".$days[($num_day['wday'] + 9) % 7 ]."</a></li>";
				else
					echo "<li><a href =\"rezultate.php?date=$day\">".$days[($num_day['wday'] + 9) % 7 ]."</a></li>";

				$day = date("Y-m-d", time() - 3 * 86400);
				if($get_date == $day)
					echo "<li class=\"active\"><a href =\"rezultate.php?date=$day\">".$days[($num_day['wday'] + 10) % 7 ]."</a></li>";
				else
					echo "<li><a href =\"rezultate.php?date=$day\">".$days[($num_day['wday'] + 10) % 7 ]."</a></li>";

				$day = date("Y-m-d", time() - 2 * 86400);
				if($get_date == $day)
					echo "<li class=\"active\"><a href =\"rezultate.php?date=$day\">".$days[($num_day['wday'] + 11) % 7 ]."</a></li>";
				else
					echo "<li><a href =\"rezultate.php?date=$day\">".$days[($num_day['wday'] + 11) % 7 ]."</a></li>";

				$day = date("Y-m-d", time() - 86400);
				if($get_date == $day)
					echo "<li class=\"active\"><a href =\"rezultate.php?date=$day\">Ieri</a></li>";
				else
					echo "<li><a href =\"rezultate.php?date=$day\">Ieri</a></li>";

				$day = date("Y-m-d", time());
				if($get_date == $day)
					echo "<li class=\"active\"><a href =\"rezultate.php?date=$day\">Azi</a></li>";
				else
					echo "<li><a href =\"rezultate.php?date=$day\">Azi</a></li>";

			?>
		</ul>
	</div>

	<div id="res" class ="bet-details">
	<?php
		unset($stmt);
		if(isset($_GET['date']))
			$data_cautare = $_GET['date'];
		else
			$data_cautare = $day;

		afiseazaRezultate($conn, $data_cautare);
	?>
	</div>
</div>


<?php
	require('pages/footer.php');
?>
</body>
</html>
