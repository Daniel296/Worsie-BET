
<div id="header">
	<div id="logo">
		<a href="index.php"><img src="images/logo.png"></a>
	</div>
	
	<div class="log-buttons">
		<button onclick="document.getElementById('id01').style.display='block'">Autentificare</button>
		<button onclick="document.getElementById('id02').style.display='block'">Inregistrare</button>
	</div>
	<!--<div class="account-box">
		<div class="username-box">
			<span class="username">daniel269</span>
			<span class="balance">265.23 Ron</span>
		</div>
		<div class="link-box">
			<a href="profile.php?page=account">Contul meu</a>
			<a href="profile.php?page=bilete">Bilete</a>
			<img alt="logout" src="images/logout.png">
		</div>
	</div>-->
	
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
				<input type="text" placeholder="Enter Username" name="name" required>
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
