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
	<!--<form id="cont">-->
		<div class="changeInfoText">
			Date personale
		</div>
			<div id="settings_err1">
				<!-- Mesaj de eroare din JAVASCRIPT -->
			</div>
			
			<div class="changeInfo">
				<div>
					<label class="content">Nume:</label>
					<input class="field" type="text" id="lastname" value="<?php echo $usr_nume;?>" onchange="validare_input(6, 0)">
				</div>

				<div>
					<label class="content">Prenume:</label>
					<input class="field" type="text" id="firstname" value="<?php echo $usr_prenume;?>" onchange="validare_input(7, 0)">
				</div>

				<div>
					<label class="content">Jude&#355:</label>
					<input class="field" type="text" id="county" value="<?php echo $usr_judet;?>" onchange="validare_input(8, 0)">
				</div>

				<div>
					<label class="content">Ora&#351:</label>
					<input class="field" type="text" id="city" value="<?php echo $usr_oras;?>" onchange="validare_input(9, 0)">
				</div>

				<div>
					<label class="content">Adresă:</label>
					<input class="field" type="text" id="address" value="<?php echo $usr_adresa;?>"  onchange="validare_input(10, 0)">
				</div>

				<div>
					<label class="content">Telefon:</label>
					<input class="field" type="text" id="phone" value="<?php echo $usr_telefon;?>"  onchange="validare_input(12)">
				</div>

				<button type="button" class="btn" onclick="schimba_date()">Schimbă date</button>
			<!--</form>-->
		</div>
	<!--</form>-->


	
	<div class="changePasswordText">
		Schimbare parolă
	</div>
			<div id="settings_err2">
				<!-- Mesaj de eroare din JAVASCRIPT -->
			</div>
			
			<div class="changePassword">			
				<div class="centrare">
					<div>
						<label class="content">Parolă actuală:</label>
						<input class="field" type="text" id="old_password" onchange="validare_input(13, 0)">
					</div>

					<div>
						<label class="content">Parolă nouă:</label>
						<input class="field" type="text" id="password" onchange="validare_input(4, 0)">
					</div>

					<div>
						<label class="content">Confirmare parolă:</label>
						<input class="field" type="text" id="re_password" onchange="validare_input(5, 0)">
					</div>

					<div>
						<button type="button" class="btn" onclick="schimba_parola()">Schimbă parolă</button>
					</div>
				</div>
		</div>



	<div class="changeEmailText">
		Schimbare email
	</div>

			<div id="settings_err3">
				<!-- Mesaj de eroare din JAVASCRIPT -->
			</div>

			<div class="changeEmail">
				<div>
					<label class="content">E-mail actual:</label>
					<input class="field" type="text" id="current_email" onchange="validare_input(2, 0)">
				</div>

				<div>
					<label class="content">E-mail nou:</label>
					<input class="field" type="text" id="new_email" onchange="validare_input(3, 0)">
				</div>
				<button type="button" class="btn" onclick="schimba_email()">Schimbă email</button>
			
			</div>
</div>



<script src="js/validari.js"></script>
<?php

function showError($x) {
	if(isset($_GET['err'])) {
		$message = "";

		if($x == 1) {
			if($_GET['err'] == '111') {$message .= "* Numele poate con&#355ine doar caractere alfabetice.";}
			else if($_GET['err'] == '121') {$message .= "* Prenume poate con&#355ine doar caractere alfabetice.";}
			else if($_GET['err'] == '131') {$message .= "* Numele poate con&#355ine doar caractere alfabetice.";}
			else if($_GET['err'] == '141') {$message .= "* Numele poate con&#355ine doar caractere alfabetice.";}
			else if($_GET['err'] == '151') {$message .= "* Adresa poate con&#355ine doar caractere alfanumerice.";}
			else if($_GET['err'] == '161') {$message .= "* Numarul de telefon poate con&#355ine doar cifre.";}
		} else if($x == 2) {
			if($_GET['err'] == '211') {$message .= "* Noua parolă nu poate coincide cu vechea parolă.";}
			else if($_GET['err'] == '221') {$message .= "* Parolele nu coincid.";}
		} else if($x == 3) {
			if($_GET['err'] == '311') {$message .= "* Adresa de e-mail con&#355ine caractere invalide.";}
			else if($_GET['err'] == '321') {$message .= "* E-mail-urile nu pot coincide.";}
		}
		echo '<div class="showErr"> ' . $message . '</div>';
	}
}


?>