<?php
		/*$sql_query = "SELECT nume, prenume, adresa, telefon, oras, judet FROM UTILIZATORI WHERE id = ?";
		if($stmt =  $conn->prepare($sql_query)) {
			$stmt->bind_param('i', $_SESSION['id_user']);
			$stmt->execute();
			$stmt->bind_result($email, $nume, $prenume, $adresa, $telefon, $oras, $judet);
			$stmt->fetch();
		}*/
?>
<div id="setari">
	<form id="cont" method="POST" action="./php/setari_exec.php">
		<div class="changeInfoText">
			Date personale
		</div>
		<?php
		//	showError(1);
		?>
		
		<div class="changeInfo">
			<form action="./php/setari_exec.php" method="POST">
				<div>
					<label class="content">Nume:</label>
					<input class="field" type="text" name="lastname" value="<?php echo $usr_nume;?>" onchange="validate_register_data(6)">
				</div>

				<div>
					<label class="content">Prenume:</label>
					<input class="field" type="text" name="firstname" value="<?php echo $usr_prenume;?>" onchange="validate_register_data(7)">
				</div>

				<div>
					<label class="content">Judet:</label>
					<input class="field" type="text" name="county" value="<?php echo $usr_judet;?>" onchange="validate_register_data(8)">
				</div>

				<div>
					<label class="content">Oras:</label>
					<input class="field" type="text" name="city" value="<?php echo $usr_oras;?>" onchange="validate_register_data(9)">
				</div>

				<div>
					<label class="content">Adresa:</label>
					<input class="field" type="text" name="address" value="<?php echo $usr_adresa;?>"  onchange="validate_register_data(10)">
				</div>

				<div>
					<label class="content">Telefon:</label>
					<input class="field" type="text" name="phone" value="<?php echo $usr_telefon;?>"  onchange="validate_register_data(12)">
				</div>

				<button class="btn">Schimba date</button>
			</form>
		</div>
	</form>

	<form id="password" method="POST" action="./php/setari_exec.php">
		<div class="changePasswordText">
			Schimbare parola
		</div>
		<?php
		//	showError(2);
		?>
		<div class="changePassword">
			<form action="" method="POST">
				<div class="centrare">
					<div>
						<label class="content">Parola actuala:</label>
						<input class="field" type="text" name="password" value="" onchange="validate_register_data(4)">
					</div>

					<div>
						<label class="content">Parola noua:</label>
						<input class="field" type="text" name="password" value="" onchange="validate_register_data(4)">
					</div>

					<div>
						<label class="content">Confirmare parola:</label>
						<input class="field" type="text" name="re_password" value="" onchange="validate_register_data(5)">
					</div>

					<div>
						<button class="btn">Schimba parola</button>
					</div>
				</div>
			</form>
		</div>
	</form>

	<form id="email" method="POST" action="./php/setari_exec.php">
		<div class="changeEmailText">
			Schimbare email
		</div>
		<?php
		//	showError(3);
		?>
		<div class="changeEmail">
			<form action="" method="POST">
				<div>
					<label class="content">E-mail actual:</label>
					<input class="field" type="text" name="email" value="" onchange="validate_register_data(2)">
				</div>

				<div>
					<label class="content">E-mail nou:</label>
					<input class="field" type="text" name="re_email" value="" onchange="validate_register_data(2)">
				</div>
				<button class="btn">Schimba email</button>
			</form>
		</div>
	</form>
</div>


<?php

function showError($x) {
	if(isset($_GET['err'])) {
		$message = "";

		if($x == 1) {
			if($_GET['err'] == '111') {$message .= "* Numele poate contine doar caractere alfabetice.";}
			else if($_GET['err'] == '121') {$message .= "* Prenume poate contine doar caractere alfabetice.";}
			else if($_GET['err'] == '131') {$message .= "* Numele poate contine doar caractere alfabetice.";}
			else if($_GET['err'] == '141') {$message .= "* Numele poate contine doar caractere alfabetice.";}
			else if($_GET['err'] == '151') {$message .= "* Adresa poate contine doar caractere alfanumerice.";}
			else if($_GET['err'] == '161') {$message .= "* Numarul de telefon poate contine doar cifre.";}
		} else if($x == 2) {
			if($_GET['err'] == '211') {$message .= "* Noua parola nu poate coincide cu vechea parola.";}
			else if($_GET['err'] == '221') {$message .= "* Parola nu coincide cu confirmarea parolei.";}
		} else if($x == 3) {
			if($_GET['err'] == '311') {$message .= "* Adresa de e-mail contine caractere invalide.";}
			else if($_GET['err'] == '321') {$message .= "* Noua adresa de e-mail nu poate coincide cu vechea adresa.";}
		}
		echo '<div class="showErr"> ' . $message . '</div>';
	}
}


?>