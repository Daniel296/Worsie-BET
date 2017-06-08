
<?php
	require("php/database/connect2DB.php");
	session_start();
?>


<div id="header">
	<div id="logo">
		<a href="generare_curse.php"><img src="images/logo1.png"></a>
	</div>
	
	<div class="links">
		<ul>
			<li><a <?php if(explode('/', $_SERVER['PHP_SELF'])[3] == 'generare_curse.php') echo "class=\"active\""; ?> href="generare_curse.php">Generare curse</a></li>
			<li><a <?php if(explode('/', $_SERVER['PHP_SELF'])[3] == 'top_bilete.php') echo "class=\"active\""; ?> href="top_bilete.php">Top bilete</a></li>
			<li><a <?php if(explode('/', $_SERVER['PHP_SELF'])[3] == 'top_pariori.php') echo "class=\"active\""; ?> href="top_pariori.php">Top pariori</a></li>
			<li><a <?php if(explode('/', $_SERVER['PHP_SELF'])[3] == 'evolutie_sume.php') echo "class=\"active\""; ?> href="evolutie_sume.php">Evolu&#355ia sumelor pariate</a></li>
		</ul>
	</div>

</div>

