<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Acasa - WorsieBet</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-header.css">
	<link rel="stylesheet" type="text/css" href="css/popup-style.css">
</head>
<body>
<?php
	require('pages/header.php');
?>

<div id="main">
	<div class="thumbnail" onMouseOut="hide('bet-now')" onMouseOver="show('bet-now')" >
		<img src="images/betting-img.jpg" id="betting-img">
		<a href="pariuri.php?date=<?php echo date("Y-m-d", time());?>">
			<div id="bet-now">
				<span id="bet-now-text">PARIAZA ACUM</span>
			</div>
		</a>
	</div>
	
</div>

<?php
	require('pages/footer.php');
?>

<script>
  function show(id) {
    document.getElementById(id).style.visibility = "visible";
	document.getElementById(id).style.display = "block";
  }
  function hide(id) {
    document.getElementById(id).style.visibility = "hidden";
	document.getElementById(id).style.display = "none";
  }
</script>
</body>
</html>