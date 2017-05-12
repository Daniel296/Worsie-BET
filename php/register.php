<!DOCTYPE html>
<html>
	<link rel="stylesheet" type="text/css" href="../css/popup-style.css">
<body>


<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">
	<?php
		function print_error($error_msg) {
			echo "<p style=\"color: red; margin-top: -15px;\">*$error_msg</p>";
		}

		require "../php/connect2DB.php";

		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		if(empty($_POST) == false) {
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$username = test_input($_POST["username"]);
				$firstname = test_input($_POST["fisrtname"]);
				$lastname= test_input($_POST["lastname"]);
				$email = test_input($_POST["email"]);
				$password = test_input($_POST['password']);

			}

			/*Verificam daca email-ul este deja in baza de date*/
			$sql_statement = $conn->prepare("BEGIN
												:result := register('$nume', '$prenume', '$adresa', '$email', '$telefon', '$parola');
											END;");
			$sql_statement->bindParam(':result', $result);
			$sql_statement->execute();

			if($result != 0) {
				if($result == 1)
					print_error("Adresa de email exista deja in baza de date!");
				if($result == 2)
					print_error("Nume sau prenume invalid. Aceste campuri trebuie sa fie de lungime cel mult 30 caractere si sa inceapa cu o litera mare (A-Za-z)");
				if($result == 3)
					print_error("Adresa trebuie sa aiba cel mult 100 de caractere!");
				if($result == 4)
					print_error("Adresa de email trebuie sa aiba cel mult 50 de caractere!");
				if($result == 5)
					print_error("Numarul de telefon trebuie sa aiba exact 10 cifre!");
				if($result == 6)
					print_error("Parola trebuie sa aiba cel putin 6 caractere!");
			}
		}
	?>

	<form class="modal-content animate" action="./logged.php" method="POST">
		<div class="imgcontainer">
		  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		  <img src="../images/login-img.png" alt="Avatar" class="avatar">
		</div>

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
				<input type="text" name="fistname" required>
			</div>

			<div class="form-login">
				<label><b>Email</b></label>
				<input type="text" name="email" required>
			</div>


			<div>
				<label><b>Parola</b></label>
				<input type="password" name="password" required>
			</div>


			<button type="submit">Register</button>
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

</body>
</html>
