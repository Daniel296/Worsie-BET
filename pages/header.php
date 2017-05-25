
<?php
	require("php/database/connect2DB.php");
	session_start();


	echo date('h:i:s', time());

?>

<?php
				/*===========LOGIN===========*/
	function login_user($conn, $username, $password) {
		/* Creeam si executam query-ul pentru a vedea daca exista user-ul in baza de date */
		unset($stmt);
		$stmt =  $conn->stmt_init();
		$sql_query = "SELECT id, trim(parola), conectat FROM UTILIZATORI WHERE username = ? AND parola = ?";
		if($stmt =  $conn->prepare($sql_query)) {
			$stmt->bind_param('ss', $username, $password);
			$stmt->execute();
			$stmt->bind_result($id_user, $hash_password, $conectat);
			$stmt->fetch();

			//password_verify($password, $hash_password) == TRUE
			if(isset($id_user) and $conectat == 0 ) {
				/* Pornim sesiunea si setam parametrii la sesiune */
				$_SESSION['id'] = $id_user;
				$_SESSION['username'] = $username;

				/* Facem update la campul "conectat" */
				unset($stmt);
				$stmt =  $conn->stmt_init();
				$sql_query = "UPDATE utilizatori SET conectat = 1 WHERE id = ?";
				if($stmt =  $conn->prepare($sql_query)) {
					$stmt->bind_param('d', $id_user);
					$stmt->execute();
					if($conn->affected_rows == 0)
						print_login_error("Update error");
				}
			}
			else {
				if($conectat == 1)
					print_login_error("Sunteti deja conectat cu acest username!");
				else
					print_login_error("Username sau parola gresite");
			}
		}
	}

	/*Daca sunt setate datele necesare pentru logare*/
	if (isset($_POST['username_login']) and isset($_POST['password'])) {
		/* Scoatem caracterele speciale din username si parola pentru evitarea sql injection*/
		$username = mysql_real_escape_string($_POST['username_login']);
		$password = mysql_real_escape_string($_POST['password']);

		/* Apelam functia care face logarea */
		login_user($conn, $username, $password);
	}

 ?>

 <?php
						/*=============REGISTER===========*/
	 if (isset($_POST['bday']) and isset($_POST['username']) and isset($_POST['lastname']) and isset($_POST['firstname']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['re_password'])) {
		 $ok = false;

		 /* Scoatem caracterele speciale din username si parola pentru evitarea sql injection*/
		 $username = mysql_real_escape_string($_POST['username']);
		 $lastname = mysql_real_escape_string($_POST['lastname']);
		 $firstname = mysql_real_escape_string($_POST['firstname']);
		 $email = mysql_real_escape_string($_POST['email']);
		 $password = mysql_real_escape_string($_POST['password']);
		 $re_password = mysql_real_escape_string($_POST['re_password']);
		 $birth_date = date("Y-m-d", strtotime($_POST['bday']));

		 /* Validam datele introduse de utilizator si afisam mesajele de eroare corespunzatoare */
		 if(strlen($username) < 6 or strlen($username) > 30)
			 print_register_error("Username-ul trebuie sa aiba intre 6 si 30 de caractere");
		 if(preg_match('/^[A-Za-z][A-Za-z0-9]$/', $username))
			 print_register_error("Username-ul poate sa contina doar litere si cifre");
		 if(strlen($firstname) > 15)
			 print_register_error("Lungimea prenumelui este prea mare");
		 if(strlen($lastname) > 15)
			 print_register_error("Lungimea numelui este prea mare");
		 if(!preg_match('/[A-Za-z]$/', $firstname) or !preg_match('/[A-Za-z]$/', $lastname) )
			 print_register_error("Numele poate sa contina doar litere");
		 if(strlen($password) > 30)
			 print_register_error("Parola este prea lunga");
		 if($password != $re_password)
			 print_register_error("Parolele sunt diferite");


		 /* Criptam parola */
		 //$hash_password = password_hash($password, PASSWORD_DEFAULT);
		 $hash_password = $password;

		 /* Verificam daca username-ul sau email-ul exista deja in baza de date */
		 $stmt =  $conn->stmt_init();
		 $sql_query = "SELECT username, email FROM utilizatori WHERE username = ? or email = ?";
		 if($stmt =  $conn->prepare($sql_query)) {
			 $stmt->bind_param('ss', $username, $email);
			 $stmt->execute();
			 $stmt->bind_result($username1, $email1);
			 $stmt->fetch();
			 echo "H1 ";
			 if(isset($username1) == false and isset($email1) == false) {
				 echo "H2 ";
				 unset($stmt);
				 $stmt =  $conn->stmt_init();
				 $sql_query = "INSERT INTO UTILIZATORI (username, parola, email, nume, prenume, data_nasterii)
								 VALUES (?, ?, ?, ?, ?, DATE_FORMAT(?,'%Y-%m-%d'))";
				 if($stmt =  $conn->prepare($sql_query)) {
					 $stmt->bind_param('ssssss', $username, $hash_password, $email, $lastname, $firstname, $birth_date);
					 $stmt->execute();
					 echo "H3 ";

					 if (!$conn->commit()) {
						 print_register_error("Transaction commit failed");
						 exit();
					 }

					 /*Daca am ajuns pana aici inseamna ca inregistrarea a avut loc cu succes, asa ca facem login */
					 login_user($conn, $username, $password);
				 }
				 else {
					 if(isset($username1) == true and $username1 == $username)
						 print_error("Acest username exista deja");
					 if(isset($email1) == true and $email1 == $email)
						 print_error("Aceasta adresa de email exista deja");
					 echo "H5";
				 }
			 }
			 else {
				 print_register_error("Username-ul exista deja in baza de date");
			 }
		 }
	 }
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
				<input type="text" placeholder="Enter Username" name="username_login" required>
			</div>

			<div  class="form-login">
				<label><b>Parola</b></label>
				<input type="password" placeholder="Enter Password" name="password" required>
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
