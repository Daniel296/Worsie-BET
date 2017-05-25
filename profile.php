<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
	require('pages/header.php');
	if(!isset($_SESSION['id']))
		header('Location: ./index.php');
?>
<html>
<head>
	<title>Profil - WorsieBet</title>
	<link rel="stylesheet" type="text/css" href="css/profile-style.css">
	<link rel="stylesheet" type="text/css" href="css/style-header.css">
	<link rel="stylesheet" type="text/css" href="css/popup-style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   

    
</head>

<body>
	<div id="leftMenu">
		<div class="menu">
			<ul>
				<li><a href="profile.php?page=account">Contul meu</a></li>
				<li class="active"><a href="profile.php?page=setari">Setari cont</a></li>
				<li><a href="profile.php?page=bilete">Istoric Bilete</a></li>
			</ul>
		</div>
		<div class="dateCont">
			<?php echo $usr_nume . " " . $usr_prenume; ?> <br>
			Ultima conectare: 27.04.2017 09:57
		</div>
	</div>

<?php

if(isset($_GET['page'])) {
	switch ($_GET['page']) {
		case 'account' :
			include ('./php/profile/account.php');
			break;

		case 'setari' :
			include ('./php/profile/setari.php');
			break;

		case 'bilete' :
			include ('./php/profile/istoric_bilete.php');
			break;

		case 'statistici' :
			include ('./php/profile/statistici.php');
			break;

		default:
			include ('./php/profile/account.php');
			break;
	}
}
else {
	include ('./php/profile/account.php');
}
?>

	<?php
		require('pages/footer.php');
	?>
</body>

</html>
