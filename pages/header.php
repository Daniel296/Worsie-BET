
<?php
	require("php/database/connect2DB.php");
	session_start();

	require("php/login-register.php");
?>

<div id="header">
	<div id="logo">
		<a href="index.php"><img src="images/logo.png"></a>
	</div>

	<?php
		if(isset($_SESSION['id'])) {
			/* Daca user-ul este logat atunci selectam username-ul si balanta din baza de date */
			$stmt =  $conn->stmt_init();
			$sql_query = "SELECT username, email, nume, prenume, adresa, data_nasterii, telefon, oras, judet, balanta FROM UTILIZATORI WHERE id = ?";

			if($stmt =  $conn->prepare($sql_query)) {

				$stmt->bind_param('d', $_SESSION['id']);
				$stmt->execute();
				$stmt->bind_result($usr_username, $usr_email, $usr_nume, $usr_prenume, $usr_adresa, $usr_data_nasterii, $usr_telefon, $usr_oras, $usr_judet, $usr_balanta);
				$stmt->fetch();
			}
	 ?>
		 <div class="account-box">
			 <div class="username-box">
				 <span class="username"><?php echo $usr_username ?></span>
				 <span class="balance"><?php echo $usr_balanta . " RON" ?></span>
			 </div>
			 <div class="link-box">
				 <a href="profile.php?page=account">Contul meu</a>
				 <a href="profile.php?page=bilete">Bilete</a>
				 <a href="php/logout.php"><img alt="logout" src="images/logout.png"></a>
			 </div>
		 </div>
	<?php } else { ?>
		<div class="log-buttons">
			<button onclick="document.getElementById('id01').style.display='block'">Autentificare</button>
			<button onclick="document.getElementById('id02').style.display='block'">Inregistrare</button>
		</div>
	<?php } ?>

	<div class="links">
		<ul>
			<li><a class="active" href="index.php">Acasa</a></li>
			<li><a href="pariuri.php?date=<?php echo date("Y-m-d", time());?>">Pariuri</a></li>
			<li><a href="rezultate.php">Rezultate</a></li>
			<li><a href="regulament.php">Regulament</a></li>
			<li><a href="desprenoi.php">Despre Noi</a></li>
		</ul>
	</div>
</div>

<div id="id01" class="modal">
	<form action="." class="modal-content animate" method="POST">
		<div class="imgcontainer">
		  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		  <img src="images/login-img.png" alt="Avatar" class="avatar">
		</div>

		<?php
			/* Aceasta functie afiseaza mesajele de eroare care apar in urma validarii datelor introduse de utilizator*/
	 		function print_login_error($err) {
		 		echo "<p style=\"color: red;\"> *$err </p>";
		 		$ok = true;
	 		}
		 ?>

		<div class="container">
			<div class="form-login">
				<label><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="username_login" required />
			</div>

			<div  class="form-login">
				<label><b>Parola</b></label>
				<input type="password" placeholder="Enter Password" name="password" required />
			</div>

			<button type="submit">Login</button>
		</div>
	</form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


<div id="id02" class="modal">

	<form class="modal-content animate" method="POST">
		<div class="imgcontainer">
		  	<span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
		  	<img src="images/login-img.png" alt="Avatar" class="avatar">
		</div>

		<?php
			/* Aceasta functie afiseaza mesajele de eroare care apar in urma validarii datelor introduse de utilizator*/
	 		function print_register_error($err) {
		 		echo "<p> *$err </p>";
		 		$ok = true;
	 		}
		 ?>
		<div class="container">
			<div class="form-login">
				<label><b>Username</b></label>
				<input type="text" name="username" required>
			</div>

			<div class="form-login">
				<label><b>Nume</b></label>
				<input type="text" name="lastname" required>
			</div>

			<div class="form-login">
				<label><b>Prenume</b></label>
				<input type="text" name="firstname" required>
			</div>

			<div class="form-login">
				<label><b>Data nasterii</b></label>
				<input type="date" name="bday" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required >
			</div>

			<div class="form-login">
				<label><b>Email</b></label>
				<input type="email" name="email" required>
			</div>

			<div class="form-login">
				<label><b>Parola</b></label>
				<input type="password" name="password" required>
			</div>

			<div class="form-login">
				<label><b>Reintroduceti parola</b></label>
				<input type="password" name="re_password" required>
			</div>

			<button type="submit">Register</button>
		</div>

	</form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
