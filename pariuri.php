<!DOCTYPE HTML>
<html>
<head>
	<title>Pariuri - WorsieBet</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-header.css">
	<link rel="stylesheet" type="text/css" href="css/popup-style.css">
</head>
<body>

	<?php
		require('pages/header.php');
	?>

	<div class="fixed-wrapper">
		<div class="check-ticket">
			<p>Verificati bilet</p>
			<form method="POST">
				<input type="text" name="PIN" placeholder="Introduceti PIN-ul biletului">
				<button type="submit">Verificati</button>
			</form>
		</div>

		<div class="bet-ticket">
			<p>Plaseaza bilet</p>
			<div class="race-on-ticket">
				<div class="race-on-ticket-details">
					<span class="top-left">Burtonwood</span>
					<span class="bottom-left">Ludlow 15:30 / 18.04</span>
				</div>
				<div class="race-on-ticket-cota">
					<span class="cota-ticket">4.75</span>
					<a href="#" class="close-thik"></a>
				</div>
			</div>
			<div class="race-on-ticket">
				<div class="race-on-ticket-details">
					<span class="top-left">Pushkin Museum</span>
					<span class="bottom-left">Ludlow 15:30 / 18.04</span>
				</div>
				<div class="race-on-ticket-cota">
					<span class="cota-ticket">4.33</span>
					<a href="#" class="close-thik"></a>
				</div>
			</div>
			<div class="race-on-ticket">
				<div class="race-on-ticket-details">
					<span class="top-left">Mr Chuckles</span>
					<span class="bottom-left">Ludlow 15:30 / 18.04</span>
				</div>
				<div class="race-on-ticket-cota">
					<span class="cota-ticket">8.33</span>
					<a href="#" class="close-thik"></a>
				</div>
			</div>
			<div class="total">
					<span style="float: left;">Cota totala: </span>
					<span style="float: right;">18.45</span><br>
			</div>
			<div class="total">
					<span style="float: left;">Castig potential: </span>
					<span style="float: right;">200 RON</span><br>
			</div>
			<div class="ticket-form">
				<form method="POST">
					<span>RON:</span>
					<input type="text" placeholder="TOTAL">

					<button type="submit">Trimiteti</button>
				</form>
			</div>
		</div>
	</div>


<div id="main-pariuri">
	<div class="show-bets-day">
		<ul>
			<?php
				$num_day = getdate();
				$days = array(0 => "Luni", 1 => "Marti", 2 => "Miercuri", 3 => "Joi", 4 => "Vineri", 5 => "Sambata", 6 => "Duminica");

				$day = date("Y-m-d", time());
				echo "<li class=\"active\"><a href =\"Pariuri.php?date=$day\">Azi</a></li>";

				$day = date("Y-m-d", time() + 86400);
				echo "<li><a href =\"Pariuri.php?date=$day\">Maine</a></li>";

				$day = date("Y-m-d", time() + 2 * 86400);
				echo "<li><a href =\"Pariuri.php?date=$day\">".$days[($num_day['wday'] + 8) % 7 ]."</a></li>";

				$day = date("Y-m-d", time() + 3 * 86400);
				echo "<li><a href =\"Pariuri.php?date=$day\">".$days[($num_day['wday'] + 9) % 7 ]."</a></li>";

				$day = date("Y-m-d", time() + 4 * 86400);
				echo "<li><a href =\"Pariuri.php?date=$day\">".$days[($num_day['wday'] + 10) % 7 ]."</a></li>";

			?>
		</ul>
	</div>

	<div class="bets">
		<?php
			/* Afisam numele curselor si orele la care au loc */
			if(isset($_GET['date'])) {
				$date = $_GET['date'];
				$names_array = [];
				/* Luam numele de la toate cursele */
				$stmt =  $conn->stmt_init();
				$sql_query = "SELECT DISTINCT nume FROM curse WHERE SUBSTR(data, 1, 10) = '$date'";
				if($stmt =  $conn->prepare($sql_query)) {
					$stmt->execute();
					$stmt->bind_result($name);

					while($stmt->fetch()) {
						$names_array[] = $name;
					}
				}
				else {
					die("O eroare nesteptata s-a produs!");
				}

				/* Selectam orele la care au loc cursele */
				unset($stmt);
				for($i = 0; $i < count($names_array); $i++) {
					echo "<div class=\"bet\">
							<a href=\"Pariuri.php?date=$date&race=$names_array[$i]\">$names_array[$i]</a>";
					$stmt =  $conn->stmt_init();
					$sql_query = "SELECT DISTINCT SUBSTR(data, 12, 5) as ora FROM curse WHERE SUBSTR(data, 1, 10) = '$date' and nume = '$names_array[$i]' ORDER BY ora";
					if($stmt =  $conn->prepare($sql_query)) {
						$stmt->execute();
						$stmt->bind_result($time);
						echo "<div class=\"times\">";
						while($stmt->fetch()) {
							echo "<span>$time</span>";
						}
					}
					else {
						die("O eroare nesteptata s-a produs!");
					}
					echo "</div></div>";
				}
			}
		 ?>
	</div>

	<?php
		$races = array();
		if(isset($_GET['race']) and isset($_GET['date'])) {
			$race = $_GET['race'];
			$date = $_GET['date'];

			unset($stmt);
			$current_time = date('h:i:s', time());
			$stmt =  $conn->stmt_init();
			$sql_query = "SELECT id, nume, id_cai, id_jochei, vreme, sanse_castig, substr(data, 12,5), cote  FROM curse WHERE nume = ? AND SUBSTR(data, 1, 10) = ? AND SUBSTR(data, 12,8) > ?";
			if($stmt =  $conn->prepare($sql_query)) {
				$stmt->bind_param('sss', $race, $date, $current_time);
				$stmt->execute();
				$stmt->bind_result($id_race, $name, $id_horse_str, $id_jockeys_str, $weather, $win_rate_str, $time, $odds_str);

				/* Punem toate informatiile din baza de date intr-un array de array-uri asociative */
				$i = 0;
				while($stmt->fetch()) {
					$races[$i] = array();
					$races[$i]['id_race'] = $id_race;
					$races[$i]['name'] = $name;
					$races[$i]['id_horses'] = $id_horse_str;
					$races[$i]['id_jockeys'] = $id_jockeys_str;
					$races[$i]['weather'] = $weather;
					$races[$i]['win_rate'] = $win_rate_str;
					$races[$i]['time'] = $time;
					$races[$i]['odds'] = $odds_str;
					$i++;
				}
				// 
				// /*  */
				// for($i = 0; $i < count($races); $i++) {
				// 	echo "    ";
				// 	echo $races[$i]['id_race'] . " - ";
				// 	echo $races[$i]['name'] . " - ";
				// 	echo $races[$i]['id_horses'] . " - ";
				// 	echo $races[$i]['id_jockeys'] . " - ";
				// 	echo $races[$i]['weather'] . " - ";
				// 	echo $races[$i]['win_rate'] . " - ";
				// 	echo $races[$i]['time'] . " - ";
				// 	echo $races[$i]['odds'] . " - ";
				// 	echo "<br><br>";
				// }
			}
			else {
				echo "error1";
			}
		}

		/* Facem split la stringurile care contin id-uri, win rate si cote */
		$ids_horses = array();
		$ids_jockeys = array();
		$win_rates = array();
		$odds = array();

		for($i = 0; $i < count($races); $i++) {
			$ids_horses[$i] = array();
			$ids_jockeys[$i] = array();
			$win_rates[$i] = array();
			$odds[$i] = array();

			$ids_horses[$i] = explode(' ', $races[$i]['id_horses']);
			$ids_jockeys[$i] = explode(' ', $races[$i]['id_jockeys']);
			$win_rates[$i] = explode(' ', $races[$i]['win_rate']);
			$odds[$i] = explode(' ', $races[$i]['odds']);
		}

		/* Luam din baza de date toate detaliile despre cai */
		$horses_details = array();
		$jockeys_details = array();
		for($i = 0; $i < count($races); $i++) {
			$horses_details[$i] = array();
			$jockeys_details[$i] = array();
			/* Formam interogarea pentru a obtine detaliile pentru toti caii */
			$sql_query = "SELECT nume, varsta, greutate FROM cai WHERE ";
			for($j = 0; $j < count($ids_horses[$i]); $j++) {
				$sql_query .= " id = " . $ids_horses[$i][$j] . " or ";
			}
			$sql_query = substr($sql_query, 0, strlen($sql_query) - 4);

			/*Luam detaliile despre cai */
			if($stmt =  $conn->prepare($sql_query)) {
				$stmt->execute();
				$stmt->bind_result($nume, $varsta, $greutate);

				$k = 0;
				while($stmt->fetch()) {
					$horses_details[$i][$k] = array();
					$horses_details[$i][$k]['nume'] = $nume;
					$horses_details[$i][$k]['varsta'] = $varsta;
					$horses_details[$i][$k]['greutate'] = $greutate;
					$k++;
				}
			}


			/* Formam interogarea pentru a obtine detaliile pentru toti jocheii */
			$sql_query = "SELECT nume, vesta, antrenor FROM jochei WHERE ";
			for($j = 0; $j < count($ids_jockeys[$i]); $j++) {
				$sql_query .= " id = " . $ids_jockeys[$i][$j] . " or ";
			}
			$sql_query = substr($sql_query, 0, strlen($sql_query) - 4);

			/*Luam detaliile despre jochei */
			if($stmt =  $conn->prepare($sql_query)) {
				$stmt->execute();
				$stmt->bind_result($nume, $vesta, $antrenor);

				$k = 0;
				while($stmt->fetch()) {
					$jockeys_details[$i][$k] = array();
					$jockeys_details[$i][$k]['nume'] = $nume;
					$jockeys_details[$i][$k]['vesta'] = $vesta;
					$jockeys_details[$i][$k]['antrenor'] = $antrenor;
					$k++;
				}
			}
		}

		/* Afisam informatiile in pagina */
		for($i = 0; $i < count($races); $i++) {
			if(isset($races[$i])) {
	?>

	<div class ="bet-details">
		<div class="bet-race-bar">
			<?php
				echo $races[$i]['name'];
				echo "<span>" . $races[$i]['time'] . "</span>";
				echo "<span class=\"weather\">Meteo: " . $races[$i]['weather'] . "</span>";
			?>
		</div>
		<div class="bet-details-head">
			<div class="collumn1">
				<span class="top">Nr.</span>
				<span class="bottom">(Staul)</span>
			</div>
			<div class="collumn2">
				<span class="top">Vesta Jocheu</span>
			</div>
			<div class="collumn3">
				<span class="top-left">Cal</span>
				<span class="bottom-left">Antrenor/Jocheu</span>
			</div>
			<div class="collumn2">
				<span class="top">Sanse de castig</span>
			</div>
			<div class="collumn1">
				<span class="top">Greutate</span>
				<span class="bottom">Varsta</span>
			</div>
			<div class="collumn2">
				<span class="top">Cota</span>
			</div>
		</div>
		<div class="bet-details-body">
			<?php
				for($j = 0; $j < count($ids_horses[$i]); $j++) {
			?>

			<div class="team">
				<div class="collumn1">
					<span class="top">1</span>
					<span class="bottom">(6)</span>
				</div>
				<div class="collumn2">
					<img alt="vesta-jocheu" src="<?php echo $jockeys_details[$i][$j]['vesta']; ?>">
				</div>
				<div class="collumn3">
					<span class="top-left"><?php echo $horses_details[$i][$j]['nume'] ?></span>
					<span class="bottom-left"><?php echo $jockeys_details[$i][$j]['nume'] . "/" . $jockeys_details[$i][$j]['antrenor']; ?></span>
				</div>
				<div class="collumn2">
					<div class="win-chance">
						<span><?php echo $win_rates[$i][$j] . "%"; ?></span>
					</div>
				</div>
				<div class="collumn1">
					<span class="top"><?php echo $horses_details[$i][$j]['greutate'] ?></span>
					<span class="bottom"><?php echo "Varsta - " . $horses_details[$i][$j]['varsta'] ?></span>
				</div>
				<div class="collumn2">
					<form method="POST">
						<button name="cota" value="" type="button"><span class="cota"><?php echo $odds[$i][$j]; ?></span></button>
					</form>
				</div>
			</div>

			<?php } ?>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
</div>
<?php
	require('pages/footer.php');
?>
</body>
</html>
