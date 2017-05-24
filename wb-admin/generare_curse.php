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
					DATĂ INTRODUCERE CURSE: 
					 <input type="date" name="date1" min=
						 <?php
							 echo date('Y-m-d');
						 ?>
					 >
					 
					<input type="submit" value="Generează!"> 
					</form>
				</div>
			<?php
				require('pages/footer.php');
			?>
		</div>
		
		<?php
		if(empty($_POST) == false) {
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
					//data_cursei
					$date1=$_POST["date1"];
					//numele_cursei
					$nume_curse=array("Catterick", "Goodwood", "Warwick", "Tipperary", "Chelmsford City", "Sandown","Bath","Musselburgh", "Pontefract", "Haydock");
					$index_cursa = array_rand($nume_curse, 1);
					$cursa = $nume_curse[$index_cursa];

					//cote_cai+jochei (5)
					$cote=array(4.50,6.00,7.00,4.50,5.50,5.00,7.00,8.00,8.50,4.00,7.50,6.50);
					$index_cota = array_rand($cote,5);
					$cota =$cote[$index_cota[0]]; //de 1,2,3,4...
					
					//vremea
					$lista_vreme=array("10°C insorit", "14°C innorat", "19°C insorit", "17°C averse de ploaie", "21°C posibili stropi");
					$index_vreme=array_rand($lista_vreme,1);
					$vreme=$lista_vreme[$index_vreme];
					
					//cai
					$connection = mysqli_connect('localhost', 'root', '', 'worsiebet');
					$res = mysqli_query($connection,"SELECT id FROM cai ORDER BY rand() LIMIT 5");
					if($res === FALSE) { 
						die(mysql_error()); // TODO: better error handling
					}
					$cai='';
					while ($row = $res->fetch_assoc()) {
						$cai = $cai.$row['id'].' ';
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
					
					$insert = mysqli_query($connection,"INSERT INTO curse (nume, id_cai, id_jochei, vreme, data, sanse_castig, cote) VALUES ('$cursa','$cai','$jochei','$vreme',CAST('". $date1 ."' AS DATE),'0','$cota')");
					if($insert === FALSE) { 
						die(mysql_error()); // TODO: better error handling
					}
					else {
						echo "S-a inserat cu succes in baza de date!";
					}
			}
		}
		?>
	</body>
</html>
