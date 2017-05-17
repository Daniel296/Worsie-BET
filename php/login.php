<!DOCTYPE html>
<html>
	<link rel="stylesheet" type="text/css" href="../css/popup-style.css">
<body>


<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">

	<form class="modal-content animate" action="./logged.php" method="POST">
		<div class="imgcontainer">
		  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		  <img src="../images/login-img.png" alt="Avatar" class="avatar">
		</div>

		<div class="container">
			<div class="form-login">
				<label><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="username" required>
			</div>

			<div>
				<label><b>Parola</b></label>
				<input type="password" placeholder="Enter Password" name="password" required>
			</div>

			<button type="submit">Login</button>
		</div>
	</form>
</div>

<?php
	/*Validam datele introduse*/
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	/*Daca sunt setate datele necesare pentru logare, verificam daca exista contul*/
	if(empty($_POST) == false) {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$username = test_input($_POST["username"]);
			$password = test_input($_POST["password"]);

			$sql_statement = $conn->prepare("SELECT :id FROM UTILIZATORI WHERE parola = :parola AND username = :username");
			//$sql_statement->bindParam(':id', $id_user);
			$sql_statement->bindParam(':parola', $password);
			$sql_statement->bindParam(':username', $username);
			$sql_statement->execute();

			if($id_user != -1) {
				session_start();
				$_SESSION['id_user'] = $id_user;
				$_SESSION['username'] = $username;
			}
			else {
				echo "<p style=\"color: red; margin-top: -15px; margin-bottom: -5px;\">*Acest cont nu exista!</p><br>";
				sleep(100000);
			}

		}
	}

 ?>
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
