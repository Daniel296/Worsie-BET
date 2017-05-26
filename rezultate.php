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
?>

<div id="main-results">

	<div class="search-bar">
		<form  method="POST">
			<input name="search" placeholder="Search...">
			<div class="search-img">
				<img src="images/search.png" alt="search">
			</div>
		</form>
	</div>


	<div class="show-bets-day">
		<ul>
			<?php
				$num_day = getdate();
				$days = array(0 => "Luni", 1 => "Marti", 2 => "Miercuri", 3 => "Joi", 4 => "Vineri", 5 => "Sambata", 6 => "Duminica");

				$day = date("Y-m-d", time() - 4 * 86400);
				echo "<li><a href =\"rezultate2.php?date=$day\">".$days[($num_day['wday'] + 9) % 7 ]."</a></li>";

				$day = date("Y-m-d", time() - 3 * 86400);
				echo "<li><a href =\"rezultate2.php?date=$day\">".$days[($num_day['wday'] + 10) % 7 ]."</a></li>";

				$day = date("Y-m-d", time() - 2 * 86400);
				echo "<li><a href =\"rezultate2.php?date=$day\">".$days[($num_day['wday'] + 11) % 7 ]."</a></li>";

				$day = date("Y-m-d", time() - 86400);
				echo "<li><a href =\"rezultate2.php?date=$day\">Ieri</a></li>";

				$day = date("Y-m-d", time());
				echo "<li class=\"active\"><a href =\"rezultate2.php?date=$day\">Azi</a></li>";
			?>
		</ul>
	</div>

	<div class ="bet-details">
	<?php 
		if(isset($_GET['date']))
			afiseazaRezultate($conn, $_GET['date']);
		else
			afiseazaRezultate($conn, $day()); ?>
	</div>
</div>
                      

<?php
	require('pages/footer.php');
?>
</body>
</html>
