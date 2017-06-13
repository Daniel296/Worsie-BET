<?php

if(isset($_GET['page'])) {
	$pagina = $_GET['page'];
	if($pagina != "account" && $pagina != "setari" && $pagina != "bilete")
	 	header('Location: ./profile.php?page=account');
}

function actualizareBilete($conn) {
/* Trecerea unui bilet din starea de asteptare in starea pierdut/castigat */
		$i=0;
		$zero=0;
		$lengthWords = array();
		$ids = array();
		$stmt =  $conn->stmt_init();
		$sql_query = "SELECT id, pariuri,suma_castig FROM bilete WHERE id_user = ? AND status = ?";
		if($stmt =  $conn->prepare($sql_query)) {
			$stmt->bind_param('ii', $_SESSION['id'],$zero);
			$stmt->execute();
			$stmt->bind_result($id, $pariuri,$suma_castig);
			while($stmt->fetch()) {
				$castig[$i]=$suma_castig;
				$ids[$i]=$id;
				$bets = explode(' ', $pariuri);
				$lengthWords[$i] = count($bets);
				$count=0;
				for($j=0; $j<$lengthWords[$i]; $j++) {
					$arrayBets[$i][$count] = $bets[$j];
					$count++;
				}
				$i++;
			}
		}
		//Luam fiecare bilet in parte si selectam id_ul cursei si id_ul calului pe care l-a pariat

		$count2=0;
		for($j=0; $j<$i; $j++) {
			for($k=0; $k<$lengthWords[$j]; $k++) {
				$id_cursa_id_cal = explode('.',$arrayBets[$j][$k]);
				$stmt =  $conn->stmt_init();
				$sql_query = "SELECT id_cai FROM rezultate WHERE id_cursa = ?";
				if($stmt =  $conn->prepare($sql_query)) {
					$stmt->bind_param('i', $id_cursa_id_cal[0]);
					$stmt->execute();
					$stmt->bind_result($id_cai);
					while($stmt->fetch()) {
						$cal_castigator[$id_cursa_id_cal[0]] = explode(' ',$id_cai); //Avem calul castigator, ramane sa comparam cu ce a pus Vasile
						//$count2++;
					}

				}
			}
		}
		//echo $cal_castigator[$i][0]; cursa $i

		//Validam sau invalidam daca este castigator sau nu...

		for($j=0; $j<$i; $j++) {
			$ok=1;
			for($k=0; $k<$lengthWords[$j] ;$k++) {
				$id_cursa_id_cal = explode('.',$arrayBets[$j][$k]);
				if($cal_castigator[$id_cursa_id_cal[0]][0]!=$id_cursa_id_cal[1])
					$ok=0;
			}
			if($ok==0) {
				$stmt =  $conn->stmt_init();
				$sql_query = "UPDATE bilete SET status=-1 WHERE id = ?";
				if($stmt =  $conn->prepare($sql_query)) {
					$stmt->bind_param('i', $ids[$j]);
					$stmt->execute();
				}
				$stmt =  $conn->stmt_init();
				$sql_query = "UPDATE utilizatori SET bilete_asteptare=bilete_asteptare-1, bilete_pierdute=bilete_pierdute+1 WHERE id = ?";
				if($stmt =  $conn->prepare($sql_query)) {
					$stmt->bind_param('i', $_SESSION['id']);
					$stmt->execute();
				}
			}
			else {
				$stmt =  $conn->stmt_init();
				$sql_query = "UPDATE bilete SET status=1 WHERE id = ?";
				if($stmt =  $conn->prepare($sql_query)) {
					$stmt->bind_param('i', $ids[$j]);
					$stmt->execute();
				}
				$stmt =  $conn->stmt_init();
				$sql_query = "UPDATE utilizatori SET bilete_asteptare=bilete_asteptare-1, bilete_castigate=bilete_castigate+1, balanta=balanta+'$castig[$j]'  WHERE id = ?";
				if($stmt =  $conn->prepare($sql_query)) {
					$stmt->bind_param('i', $_SESSION['id']);
					$stmt->execute();
				}
			}
		}
	}
?>
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
				<li <?php  $pagina = 1;
							if(isset($_GET['page']))
								$pagina = $_GET['page'];
							if($_SERVER['QUERY_STRING'] == 'page=bilete&p=' . $pagina) echo "class=\"active\""; ?>><a href="profile.php?page=bilete&p=1">Istoric bilete</a></li>
			</ul>
		</div>
	</div>

<?php
require('php/actualizare_bilete.php');
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

	<?php
?>
</body>


<script>
	var parts = window.location.search.substr(1).split("&");
	var $_GET = {};
	for (var i = 0; i < parts.length; i++) {
	    var temp = parts[i].split("=");
	    $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
	}

	var pagina = $_GET['page'];
	if(pagina == "bilete") {
		var page = $_GET['p'];

		var paging_top = document.getElementById("#paging_link_top_" + page);
		var paging_bot = document.getElementById("#paging_link_bot_" + page);

		paging_top.style.color = "#910018";
		paging_bot.style.color = "#910018";
	}
</script>
