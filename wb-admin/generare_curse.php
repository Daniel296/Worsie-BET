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
					$date1=$_POST["date1"];
					//onclick="alert('Ai generat cu succes!')"
					$nume_curse=array("Catterick", "Goodwood", "Warwick", "Tipperary", "Chelmsford City", "Sandown","Bath","Musselburgh", "Pontefract", "Haydock");
					$index_cursa = array_rand($nume_curse, 1);
					$cursa = $nume_curse[$index_cursa];

			}
		}
		?>
	</body>
</html>
