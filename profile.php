<!DOCTYPE html>
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
</head>

<body>
	<div id="leftMenu">
		<div class="menu">
			<ul>
				<li <?php if($_SERVER['QUERY_STRING'] == 'page=account') echo "class=\"active\""; ?>><a href="profile.php?page=account">Contul meu</a></li>
				<li <?php if($_SERVER['QUERY_STRING'] == 'page=setari') echo "class=\"active\""; ?>><a href="profile.php?page=setari">Setări cont</a></li>
				<li <?php if($_SERVER['QUERY_STRING'] == 'page=bilete') echo "class=\"active\""; ?>><a href="profile.php?page=bilete">Istoric bilete</a></li>
			</ul>
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
