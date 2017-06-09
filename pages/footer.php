<div id="footer">
	<div class="bottom-menu">
		<a href="index.php" <?php if(explode('/', $_SERVER['PHP_SELF'])[2] == 'index.php') echo "class=\"active\""; ?>>Acasă</a> |
		<a href="pariuri.php?date=<?php echo date("Y-m-d", time());?>" <?php if(explode('/', $_SERVER['PHP_SELF'])[2] == 'pariuri.php') echo "class=\"active\""; ?>>Pariuri</a> |
		<a href="rezultate.php?date=<?php echo date("Y-m-d", time());?>" <?php if(explode('/', $_SERVER['PHP_SELF'])[2] == 'rezultate.php') echo "class=\"active\""; ?>>Rezultate</a> |
		<a href="regulament.php" <?php if(explode('/', $_SERVER['PHP_SELF'])[2] == 'regulament.php') echo "class=\"active\""; ?>>Regulament</a> |
		<a href="desprenoi.php" <?php if(explode('/', $_SERVER['PHP_SELF'])[2] == 'desprenoi.php') echo "class=\"active\""; ?>>Despre noi</a>
	</div>

	<div class="pay-methods">
		<a href="https://www.visa.ro/" target="blank"><img alt="visa" src="images/visa.png"></a>
		<a href="http://www.maestrocard.com/gateway/index.html" target="blank"><img src="images/maestro.png" alt="maestro"></a>
		<a href="https://www.mastercard.ro/ro-ro.html" target="blank"><img src="images/mastercard.png" alt="mastercard"></a>
		<a href="https://www.skrill.com" target="blank"><img src="images/skrill.png" alt="skrill"></a>
		<a href="https://www.paysafecard.com/ro-ro/" target="blank"><img src="images/paysafe.png" alt="paysafe"></a>
	</div>

	<div class="copyright">
		Copyright &copy; 2017 WorsieBet
	</div>
</div>
