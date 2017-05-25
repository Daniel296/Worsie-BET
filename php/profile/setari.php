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
			showError(1);
		?>
		
		<div class="changeInfo">
			<form action="./php/setari_exec.php" method="POST">
				<div>
					<label class="content">Nume:</label>
					<input class="field" type="text" name="nume" value="<?php echo $usr_nume;?>">
				</div>

				<div>
					<label class="content">Prenume:</label>
					<input class="field" type="text" name="prenume" value="<?php echo $usr_prenume;?>">
				</div>

				<div>
					<label class="content">Judet:</label>
					<input class="field" type="text" name="judet" value="<?php echo $usr_judet;?>">
				</div>

				<div>
					<label class="content">Oras:</label>
					<input class="field" type="text" name="oras" value="<?php echo $usr_oras;?>">
				</div>

				<div>
					<label class="content">Adresa:</label>
					<input class="field" type="text" name="adresa" value="<?php echo $usr_adresa;?>">
				</div>

				<div>
					<label class="content">Telefon:</label>
					<input class="field" type="text" name="telefon" value="<?php echo $usr_telefon;?>">
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
			showError(2);
		?>
		<div class="changePassword">
			<form action="" method="POST">
				<div class="centrare">
					<div>
						<label class="content">Parola actuala:</label>
						<input class="field" type="text" name="current_password" value="">
					</div>

					<div>
						<label class="content">Parola noua:</label>
						<input class="field" type="text" name="new_password" value="">
					</div>

					<div>
						<label class="content">Confirmare parola:</label>
						<input class="field" type="text" name="confirm_password" value="">
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
			showError(3);
		?>
		<div class="changeEmail">
			<form action="" method="POST">
				<div>
					<label class="content">E-mail actual:</label>
					<input class="field" type="text" name="current_email" value="">
				</div>

				<div>
					<label class="content">E-mail nou:</label>
					<input class="field" type="text" name="new_email" value="">
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