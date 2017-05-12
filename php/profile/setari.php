$
<div id="setari">
	<form method="POST" action="./php/setari_exec.php">
		<div class="changeInfoText">
			Date personale
		</div>

		<div class="changeInfo">
			<form action="./php/setari_exec.php" method="POST">
				<div>
					<label class="content">Nume:</label>
					<input class="field" type="text" name="nume" value="">
				</div>

				<div>
					<label class="content">Prenume:</label>
					<input class="field" type="text" name="prenume" value="">
				</div>

				<div>
					<label class="content">Judet:</label>
					<input class="field" type="text" name="judet" value="">
				</div>

				<div>
					<label class="content">Oras:</label>
					<input class="field" type="text" name="oras" value="">
				</div>

				<div>
					<label class="content">Adresa:</label>
					<input class="field" type="text" name="adresa" value="">
				</div>

				<div>
					<label class="content">Telefon:</label>
					<input class="field" type="text" name="telefon" value="">
				</div>

				<button class="btn">Schimba date</button>
			</form>
		</div>
	</form>

	<form method="POST" action="./php/setari_exec.php">
		<div class="changePasswordText">
			Schimbare parola
		</div>
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

	<form method="POST" action="./php/setari_exec.php">
		<div class="changeEmailText">
			Schimbare email
		</div>
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
