<?php
	$sql_query = "SELECT email, nume, prenume, balanta, bilete, bileteW, bileteL FROM UTILIZATORI WHERE id = ?";
	if($stmt =  $conn->prepare($sql_query)) {
		$stmt->bind_param('i', $_SESSION['id_user']);
		$stmt->execute();
		$stmt->bind_result($email, $nume, $prenume, $balanta, $bilete, $bileteW, $bileteL);
		$stmt->fetch();
	}
?>
<div id="account">
	<div class="accountName">
		<?php if(isset($_SESSION['username'])) echo $_SESSION['username']; else echo "AAA";?>
	</div>
	
	<div class="info1">
		<div class="balance1">
			<?php echo $balanta . " lei in cont"; ?>
		</div>

		<div class="winRate">
			<?php if($bileteL != 0) echo $bileteW/$bileteL . " rata de castig";
					else echo $bileteW . " rata de castig" ?>
		</div>

		<div class="totalBilete">
			<?php echo $bilete . " bilete jucate"; ?>
		</div>
	</div>
	
	<div class="info2">
		Nume: <?php echo $nume; ?><br>
		Prenume: <?php echo $prenume; ?><br>
		E-mail: <?php  echo $email; ?><br>
	</div>
</div>