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
			
			
			<div>
				<label><b>Parola</b></label>
				<input type="password" placeholder="Parola" name="password" required>
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
