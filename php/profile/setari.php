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
	<form id="cont">
		<div class="changeInfoText">
			Date personale
		</div>
		<?php
		//	showError(1);
		?>
		
		<div class="changeInfo">
			<div id="err1">
                <!-- Mesaje de eroare din JAVASCRIPT -->
            </div>
			<!--<form action="." method="POST">-->
				<div>
					<label class="content">Nume:</label>
					<input class="field" type="text" id="lastname" value="<?php echo $usr_nume;?>" onchange="validare_input(6, 0)">
				</div>

				<div>
					<label class="content">Prenume:</label>
					<input class="field" type="text" id="firstname" value="<?php echo $usr_prenume;?>" onchange="validare_input(7, 0)">
				</div>

				<div>
					<label class="content">Judet:</label>
					<input class="field" type="text" id="county" value="<?php echo $usr_judet;?>" onchange="validare_input(8, 0)">
				</div>

				<div>
					<label class="content">Oras:</label>
					<input class="field" type="text" id="city" value="<?php echo $usr_oras;?>" onchange="validare_input(9, 0)">
				</div>

				<div>
					<label class="content">Adresa:</label>
					<input class="field" type="text" id="address" value="<?php echo $usr_adresa;?>"  onchange="validare_input(10, 0)">
				</div>

				<div>
					<label class="content">Telefon:</label>
					<input class="field" type="text" id="phone" value="<?php echo $usr_telefon;?>"  onchange="validare_input(12, 0)">
				</div>

				<button type="button" class="btn" onclick="schimba_date()">Schimba date</button>
			<!--</form>-->
		</div>
	</form>


	<!--<form id="password">-->
		<div class="changePasswordText">
			Schimbare parola
		</div>

		<div id="err2">
			<!-- Mesaj de eroare din JAVASCRIPT -->
		</div>
		
		<div class="changePassword">
			
				<div class="centrare">
					<div>
						<label class="content">Parola actuala:</label>
						<input class="field" type="text" id="old_password" onchange="validare_input(13, 0)">
					</div>

					<div>
						<label class="content">Parola noua:</label>
						<input class="field" type="text" id="password" onchange="validare_input(4, 0)">
					</div>

					<div>
						<label class="content">Confirmare parola:</label>
						<input class="field" type="text" id="re_password" onchange="validare_input(5, 0)">
					</div>

					<div>
						<button type="button" class="btn" onclick="schimba_parola()">Schimba parola</button>
					</div>
				</div>
			
		</div>
	<!--</form>-->


	<!--<form id="email">-->
		<div class="changeEmailText">
			Schimbare email
		</div>

		<div id="err3">
			<!-- Mesaj de eroare din JAVASCRIPT -->
		</div>

		<div class="changeEmail">
				<div>
					<label class="content">E-mail actual:</label>
					<input class="field" type="text" id="email" value="" onchange="validare_input(2, 0)">
				</div>

				<div>
					<label class="content">E-mail nou:</label>
					<input class="field" type="text" id="re_email" value="" onchange="validare_input(2, 0)">
				</div>
				<button type="button" class="btn" onclick="schimba_email()">Schimba email</button>
			
		</div>
	<!--</form>-->
</div>



<script src="js/validari.js"></script>
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