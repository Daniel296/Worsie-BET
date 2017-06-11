
<?php
	//require('php/actualizare_bilete.php') or die();
	//actualizareBilete($conn);
?> 
<div id="account">
	<div class="accountName">
		<?php echo $_SESSION['username'];?>
	</div>
	
	<div class="info1">
		<div class="balance1">
			<?php echo $usr_balanta . " lei în cont"; ?>
		</div>

		<div class="winRate">
			<?php if($usr_bilete_pierdute != 0) echo $usr_bilete_castigate/$usr_bilete_pierdute . " rata de câ&#351tig";
					else echo $usr_bilete_castigate . " rata de câ&#351tig" ?>
		</div>

		<div class="totalBilete">
			<?php echo $usr_bilete_total . " bilete jucate"; ?>
		</div>
	</div>
	
	<div class="info2">
		Nume: <?php echo $usr_nume; ?><br>
		Prenume: <?php echo $usr_prenume; ?><br>
		E-mail: <?php  echo $usr_email; ?><br>
	</div>
</div>

