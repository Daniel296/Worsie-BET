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
					$cota1_rand = mt_rand (1.50*10, 2.50*10) / 10;
					$cota1_rand = number_format($cota1_rand,2);
					$cota2_rand = mt_rand (2.50*10, 3.50*10) / 10;
					$cota2_rand = number_format($cota2_rand,2);
					$cota3_rand = mt_rand (3.50*10, 4.50*10) / 10;
					$cota3_rand = number_format($cota3_rand,2);
					$cota4_rand = mt_rand (4.50*10, 5.50*10) / 10;
					$cota4_rand = number_format($cota4_rand,2);
					$cota5_rand = mt_rand (5.50*10, 6.50*10) / 10;
					$cota5_rand = number_format($cota5_rand,2);
					$cota = $cota1_rand . ' ' . $cota2_rand . ' ' . $cota3_rand . ' ' . $cota4_rand . ' ' . $cota5_rand;
					
					//sanse castig
					$sum_cote = 0;
					$sum_cote = $cota1_rand + $cota2_rand + $cota3_rand + $cota4_rand + $cota5_rand;
					$procent_cota_1 = $cota1_rand / $sum_cote;
					$procent_cota_2 = $cota2_rand / $sum_cote;
					$procent_cota_3 = $cota3_rand / $sum_cote;
					$procent_cota_4 = $cota4_rand / $sum_cote;
					$procent_cota_5 = $cota5_rand / $sum_cote;
					$sansa1 = $procent_cota_1*100;
					$sansa2 = $procent_cota_2*100;
					$sansa3 = $procent_cota_3*100;
					$sansa4 = $procent_cota_4*100;
					$sansa5 = $procent_cota_5*100;
					$sansa1 = intval($sansa1);
					$sansa2 = intval($sansa2);
					$sansa3 = intval($sansa3);
					$sansa4 = intval($sansa4);
					$sansa5 = intval($sansa5);
					//$sanse=array('40','50','60','30','70','50');
					//$index_sanse = array_rand($sanse,5);
					$sansa = $sansa5 . ' ' . $sansa4 . ' ' . $sansa3 . ' ' . $sansa2 . ' ' . $sansa1;
					
					//vremea
					$lista_grade=array("10 ", "14", "19", "17", "21");
					$index_grade=array_rand($lista_grade,1);
					$grade=$lista_grade[$index_grade];
					$lista_vreme = array("insorit","innorat","insorit","averse de ploaie", "posibili stropi");
					$index_vreme=array_rand($lista_vreme,1);
					$vreme=$lista_vreme[$index_vreme];
					$insert_vreme = $grade . chr(176) . 'C - ' . $vreme;
					
					//cai
					$connection = mysqli_connect('localhost', 'root', '', 'worsiebet');
					
					$res = mysqli_query($connection,"SELECT id,id_jocheu FROM cai ORDER BY rand() LIMIT 5");
					if($res === FALSE) { 
						die(mysql_error()); // TODO: better error handling
					}
					$i=0;
					$jochei='';
					$cai='';
					$new_cai = array();
					while ($row = $res->fetch_assoc()) {
						if($i==0) {
							$cai = $cai.$row['id'];
							$jochei = $jochei.$row['id_jocheu'];
						}
						else {
							$cai = $cai . ' ' . $row['id'];
							$jochei = $jochei . ' ' . $row['id_jocheu'];
						}
						$new_cai[$i]=$row['id'];
						$i++;
					}
					
					$res = mysqli_query($connection,"SELECT id FROM cai WHERE id = '$new_cai[0]' OR id = '$new_cai[1]' OR id='$new_cai[2]' OR id='$new_cai[3]' OR id='$new_cai[4]' ORDER BY meciuri_castigate/(meciuri_castigate+meciuri_pierdute) DESC");
					if($res === FALSE) { 
						die(mysql_error()); // TODO: better error handling
					}
					$top_cai = '';
					$top_jochei='';
					$checkCai=0;
					while ($row = $res->fetch_assoc()) {
						if($checkCai==0) {
							$top_cai= $top_cai . $row['id'];
							$checkCai=$checkCai+1;
															$joch = mysqli_query($connection,"SELECT id_jocheu FROM cai WHERE id = '$row[id]'");
															if($joch === FALSE) { 
																die(mysql_error()); // TODO: better error handling
															}
															while ($row = $joch->fetch_assoc()) {
																$top_jochei = $top_jochei . $row['id_jocheu'];
															}
						}
						else {
							$top_cai = $top_cai . ' ' .$row['id'];
															$joch = mysqli_query($connection,"SELECT id_jocheu FROM cai WHERE id = '$row[id]'");
															if($joch === FALSE) { 
																die(mysql_error()); // TODO: better error handling
															}
															while ($row = $joch->fetch_assoc()) {
																$top_jochei = $top_jochei . ' ' . $row['id_jocheu'] ;
															}
						}
					}

					/*//rezultat
					$rezultat = '';
					//$top_cai = '';
					$length = count($new_cai);
					//$top_jochei ='';
					for ($i = 0; $i < $length; $i++) {
						if($res === $length) {
							//$top_cai = $top_cai . $new_cai[$i];
							//$top_jochei = $top_jochei . $new_jochei[$i];
							$rezultat = $rezultat . $new_cai[$i] . '.' . $new_jochei[$i];
						}
						else {
							//$top_cai = $top_cai . $new_cai[$i] . ' ';
							//$top_jochei = $top_jochei . $new_jochei[$i] . ' ';
							$rezultat = $rezultat . $new_cai[$i] . '.' . $new_jochei[$i] . ' ';
						}
					}
					*/
					//update meciuri_pierdute, meciuri_castigate
					$update = mysqli_query($connection,"UPDATE cai SET meciuri_castigate = meciuri_castigate+1 WHERE id = '$new_cai[0]'");
					if($update === FALSE) { 
						die(mysql_error()); // TODO: better error handling
					}
					$update = mysqli_query($connection,"UPDATE cai SET meciuri_pierdute = meciuri_pierdute+1 WHERE id = '$new_cai[1]' OR id = '$new_cai[2]' OR id = '$new_cai[3]' OR id = '$new_cai[4]'");
					if($update === FALSE) { 
						die(mysql_error()); // TODO: better error handling
					}
					
					//insert rezultat
					$insert = mysqli_query($connection,"INSERT INTO curse (nume, id_cai, id_jochei, vreme, data, ora, sanse_castig, cote, status) VALUES ('$cursa','$cai','$jochei','$insert_vreme',CAST('". $date1 ."' AS DATE),CAST('". $time1 ."' AS TIME ),'$sansa','$cota',0)");
					if($insert === FALSE) { 
						echo "<div class=\"printing\">Nu s-a reu&#351it adăugarea în baza de date!</div>";
						die(mysql_error()); // TODO: better error handling
					}
					else {
						$res = mysqli_query($connection,"SELECT id FROM curse ORDER BY id DESC LIMIT 1");
						if($res === FALSE) { 
							echo "<div class=\"printing\">Nu s-a reu&#351it adăugarea în baza de date!</div>";
							die(mysql_error()); // TODO: better error handling
						}
						while ($row = $res->fetch_assoc()) {
							$cursa_id = $row['id'];
						}
						$insertR = mysqli_query($connection,"INSERT INTO rezultate (id_cursa, id_cai, id_jochei, data, ora) VALUES ('$cursa_id','$top_cai','$top_jochei',CAST('". $date1 ."' AS DATE),CAST('". $time1 ."' AS TIME ))");
						if($insertR === FALSE) { 
							echo "<div class=\"printing\">Nu s-a reu&#351it adăugarea în baza de date!</div>";
							die(mysql_error()); // TODO: better error handling
						}
						echo "<div class=\"printing\">S-au adăugat cu succes în baza de date!</div>";
					}
			}
		}
		?>
		
	<?php
				require('pages/footer.php');
	?>
	</body>
</html>
