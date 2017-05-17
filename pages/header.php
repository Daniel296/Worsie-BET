
<?php
	require("../php/database/connect2DB.php");
?>

<div id="header">
	<div id="logo">
		<a href="index.php"><img src="images/logo.png"></a>
	</div>

	<?php
		if(isset($_SESSION['id']) == false) {
	 ?>
		<div class="log-buttons">
			<button onclick="document.getElementById('id01').style.display='block'">Autentificare</button>
			<button onclick="document.getElementById('id02').style.display='block'">Inregistrare</button>
		</div>
	<?php } else { ?>
		<div class="account-box">
			<div class="username-box">
				<span class="username">daniel269</span>
				<span class="balance">265.23 Ron</span>
			</div>
			<div class="link-box">
				<a href="profile.php?page=account">Contul meu</a>
				<a href="profile.php?page=bilete">Bilete</a>
				<a href="php/logout.php"><img alt="logout" src="images/logout.png"></a>
			</div>
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

	<form class="modal-content animate" method="POST">
		<div class="imgcontainer">
		  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		  <img src="images/login-img.png" alt="Avatar" class="avatar">
		</div>

		<div class="container">
			<div class="form-login">
				<label><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="username" required>
			</div>

			<div  class="form-login">
				<label><b>Parola</b></label>
				<input type="password" placeholder="Enter Password" name="password" required>
			</div>

			<button type="submit">Login</button>
		</div>

	</form>
	<?php
		/*Daca sunt setate datele necesare pentru logare, verificam daca exista contul*/
		if (isset($_POST['username']) and isset($_POST['password'])) {
			/* Scoatem caracterele speciale din username si parola pentru evitarea sql injection*/
			$username = mysql_real_escape_string($_POST['username']);
			$password = mysql_real_escape_string($_POST['password']);

			/* Creeam si executam query-ul pentru a vedea daca exista user-ul in baza de date */

			$sql_query = "SELECT id FROM utilizatori WHERE username = '$username' and parola = '$password'";
			if($stmt =  $conn->prepare($sql_query)) {
				$stmt->execute();
				$stmt->bind_result($id_user);
				$stmt->fetch();

				/* Pornim sesiunea si setam parametrii la seiune */
				session_start();
				$_SESSION['id'] = $id_user;
				$_SESSION['username'] = $username;

				/* Facem update la campul "conectat" */
				unset($stmt);
				$sql_query = "UPDATE utilizatori SET conectat = 1 WHERE id = $id_user";
				if($stmt =  $conn->prepare($sql_query)) {
					$stmt->execute();
				}
				else {
					echo "Update error";
				}
			}
			else echo "Acest cont nu exista!";
		}
	 ?>
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

		<div class="container">
			<div class="form-login">
				<label><b>Username</b></label>
				<input type="text" placeholder="Username" name="name" required>
			</div>

			<div class="form-login">
				<label><b>Nume</b></label>
				<input type="text" placeholder="Nume" name="name" required>
			</div>

			<div class="form-login">
				<label><b>Prenume</b></label>
				<input type="text" placeholder="Prenume" name="name" required>
			</div>

			<div class="form-login">
				<label><b>Email</b></label>
				<input type="text" placeholder="Email" name="email" required>
			</div>


			<div class="form-login">
				<label><b>Parola</b></label>
				<input type="password" placeholder="Parola" name="password" required>
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
