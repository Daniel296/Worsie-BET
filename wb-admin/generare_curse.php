<!DOCTYPE HTML>
<html>

	<head>
		<title>GENERARE CURSE - WorsieBET</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style-header.css">
	</head>


	<body>
		<div id="container">
			<?php
				require('pages/header.php');
			?>

				<div class="generare">
					<form action="generare_curse.php" method="post">
					DATĂ CURSĂ:
					 <input type="date" name="date1" min=
						 <?php
							 echo date('Y-m-d');
						 ?>
					 >
					 ORĂ CURSĂ:
					<input type="time" name="time" />

					<input type="submit" value="Generează!">
					</form>
				</div>
		</div>

		<?php
		if(empty($_POST) == false) {
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
					//data_cursei
					$date1=$_POST["date1"];
					$time1=$_POST["time"];
					//numele_cursei
					$nume_curse=array("Catterick", "Goodwood", "Warwick", "Tipperary", "Chelmsford City", "Sandown","Bath","Musselburgh", "Pontefract", "Haydock");
					$index_cursa = array_rand($nume_curse, 1);
					$cursa = $nume_curse[$index_cursa];

					//cote_cai+jochei (5)
					$cote=array('4.50','6.00','7.00','4.50','5.50','5.00','7.00','8.00','8.50','4.00','7.50','6.50');
					$index_cota = array_rand($cote,5);
					$cota =$cote[$index_cota[0]] . ' ' . $cote[$index_cota[1]] . ' ' . $cote[$index_cota[2]] . ' ' . $cote[$index_cota[3]] . ' ' . $cote[$index_cota[4]];

					//sanse castig
					$sanse=array('40','50','60','30','70','50');
					$index_sanse = array_rand($sanse,5);
					$sansa =$sanse[$index_sanse[0]] . ' ' . $sanse[$index_sanse[1]] . ' ' . $sanse[$index_sanse[2]] . ' ' . $sanse[$index_sanse[3]] . ' ' . $sanse[$index_sanse[4]];

					//vremea
					$lista_grade=array("10 ", "14", "19", "17", "21");
					$index_grade=array_rand($lista_grade,1);
					$grade=$lista_grade[$index_grade];
					$lista_vreme = array("insorit","innorat","insorit","averse de ploaie", "posibili stropi");
					$index_vreme=array_rand($lista_vreme,1);
					$vreme=$lista_vreme[$index_vreme];
					$insert_vreme = $grade . chr(176) . 'C - ' . $vreme;

					//cai si rezultat
					$connection = mysqli_connect('localhost', 'root', '', 'worsiebet');
					$res = mysqli_query($connection,"SELECT id FROM cai ORDER BY rand() LIMIT 5");
					if($res === FALSE) {
						die(mysql_error()); // TODO: better error handling
					}
					$cai='';
					$new_array = array();
					$i=0;
					while ($row = $res->fetch_assoc()) {
						$cai = $cai.$row['id'].' ';
						//$new_array = $row;
						//array_push($new_array, $row);
						$new_array[$i]=$row['id'];
						$i++;
					}
					shuffle($new_array);
					$length = count($new_array);
					$rezultat = '';
					for ($i = 0; $i < $length; $i++) {
					  $rezultat = $rezultat . $new_array[$i] . ' ';
					}

					//jochei
					$res = mysqli_query($connection,"SELECT id FROM jochei ORDER BY rand() LIMIT 5");
					if($res === FALSE) {
						die(mysql_error()); // TODO: better error handling
					}
					$jochei='';
					while ($row = $res->fetch_assoc()) {
						$jochei = $jochei.$row['id'].' ';
					}

					$insert = mysqli_query($connection,"INSERT INTO curse (nume, id_cai, id_jochei, vreme, data, ora, sanse_castig, cote) VALUES ('$cursa','$cai','$jochei','$insert_vreme',CAST('". $date1 ."' AS DATE),CAST('". $time1 ."' AS TIME ),'$sansa','$cota')");
					if($insert === FALSE) {
						die(mysql_error()); // TODO: better error handling
					}
					else {
						$res = mysqli_query($connection,"SELECT id FROM curse ORDER BY id DESC LIMIT 1");
						if($res === FALSE) {
							die(mysql_error()); // TODO: better error handling
						}
						while ($row = $res->fetch_assoc()) {
							$cursa_id = $row['id'];
						}
						$insertR = mysqli_query($connection,"INSERT INTO rezultate (id_cursa, rezultat) VALUES ('$cursa_id','$rezultat')");
						if($insertR === FALSE) {
							die(mysql_error()); // TODO: better error handling
						}
						echo "<div class=\"printing\">S-a inserat cu succes in baza de date!</div>";
					}
			}
		}
		?>

	<?php
				require('pages/footer.php');
	?>
	</body>
</html>
