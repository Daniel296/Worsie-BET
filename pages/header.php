
<?php
	require("php/login-register.php");
	session_start();
?>

<div id="header">
	<div id="logo">
		<a href="index.php"><img src="images/logo.png"></a>
	</div>

	<?php
		if(isset($_SESSION['id'])) {
			/* Daca user-ul este logat atunci selectam username-ul si balanta din baza de date */
			$stmt =  $conn->stmt_init();
			$sql_query = "SELECT username, email, nume, prenume, adresa, data_nasterii, telefon, oras, judet, balanta, bilete_total, bilete_castigate, bilete_pierdute, bilete_asteptare FROM UTILIZATORI WHERE id = ?";

			if($stmt =  $conn->prepare($sql_query)) {

				$stmt->bind_param('d', $_SESSION['id']);
				$stmt->execute();
				$stmt->bind_result($usr_username, $usr_email, $usr_nume, $usr_prenume, $usr_adresa, $usr_data_nasterii, $usr_telefon, $usr_oras, $usr_judet, $usr_balanta, $usr_bilete_total, $usr_bilete_castigate, $usr_bilete_pierdute, $usr_bilete_asteptare);
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
				 <a href="php/logout.php?redirect=<?php echo  $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']; ?>"><img alt="logout" src="images/logout.png"></a>
			 </div>
		 </div>
	<?php } else { ?>
		<div class="log-buttons">
			<button onclick="document.getElementById('id01').style.display='block'">Autentificare</button>
			<a href="register.php"><button type="button">Inregistrare</button></a>
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
	<div class="modal-content animate" >
	<div class="imgcontainer">
		 <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		 <img src="images/login-img.png" alt="Avatar" class="avatar">
	</div>

	<div class="container">
		<div id="err-log">
			<!-- Afisare erori din Javascript -->
		</div>

		<div class="form-login">
			<label><b>Username</b></label>
			<input type="text" placeholder="Enter Username" id="username_login" required />
		</div>

		<div  class="form-login">
			<label><b>Parola</b></label>
			<input type="password" placeholder="Enter Password" id="password" required />
		</div>

		<button type="submit" onclick="login_user()">Login</button>
	</div>
	</div>
</div>

<script src="js/account.js"></script>
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
