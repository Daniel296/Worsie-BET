<!DOCTYPE HTML>
<html>
<head>
	<title>EVOLU&#354IE PARIURI - WorsieBET</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-header.css">
	<link rel="stylesheet" type="text/css" href="css/graph.css">
</head>
<body>

<?php
	require('pages/header.php');
?>

<h2>Evolu&#355ie sume pariate</h2>

<script language="JavaScript">
<!--
var myDays= 
["Duminică","Luni","Mar&#355i","Miercuri","Joi","Vineri","Sâmbătă","Duminică"]
today=new Date() 
todayDate=today.getDay()
fiveDaysAgo=myDays[(todayDate+2)%7]
fourDaysAgo=myDays[(todayDate+3)%7]
threeDaysAgo=myDays[(todayDate+4)%7]
twoDaysAgo=myDays[(todayDate+5)%7]
onedayAgo=myDays[(todayDate+6)%7]

//-->
</script>

<?php
	$connection = mysqli_connect('localhost', 'root', '', 'worsiebet');
	$res = mysqli_query($connection,"SELECT sum(suma_depusa) FROM bilete WHERE DATE(data_creare) = DATE(subdate(CURRENT_DATE,12)) ");
	if($res === FALSE) { 
		die(mysql_error()); // TODO: better error handling
	}
	while ($row = $res->fetch_assoc()) {
		$oneDayAgoBets = $row['sum(suma_depusa)'];
	}

	$res = mysqli_query($connection,"SELECT sum(suma_depusa) FROM bilete WHERE DATE(data_creare) = DATE(subdate(CURRENT_DATE,2)) ");
	if($res === FALSE) { 
		die(mysql_error()); // TODO: better error handling
	}
	while ($row = $res->fetch_assoc()) {
		$twoDaysAgoBets = $row['sum(suma_depusa)'];
	}

	$res = mysqli_query($connection,"SELECT sum(suma_depusa) FROM bilete WHERE DATE(data_creare) = DATE(subdate(CURRENT_DATE,3)) ");
	if($res === FALSE) { 
		die(mysql_error()); // TODO: better error handling
	}
	while ($row = $res->fetch_assoc()) {
		$threeDaysAgoBets = $row['sum(suma_depusa)'];
	}

	$res = mysqli_query($connection,"SELECT sum(suma_depusa) FROM bilete WHERE DATE(data_creare) = DATE(subdate(CURRENT_DATE,4)) ");
	if($res === FALSE) { 
		die(mysql_error()); // TODO: better error handling
	}
	while ($row = $res->fetch_assoc()) {
		$fourDaysAgoBets = $row['sum(suma_depusa)'];
	}

	$res = mysqli_query($connection,"SELECT sum(suma_depusa) FROM bilete WHERE DATE(data_creare) = DATE(subdate(CURRENT_DATE,5)) ");
	if($res === FALSE) { 
		die(mysql_error()); // TODO: better error handling
	}
	while ($row = $res->fetch_assoc()) {
		$fiveDaysAgoBets = $row['sum(suma_depusa)'];
	}	
	//5 si 370 vor fi limitele, in functie de asta, vom plasa in grafic, punctele de referinta, conform js
	//
?>

<svg version="1.2" class="graph" role="img">

<g class="grid x-grid" id="xGrid">
  <line x1="90" x2="90" y1="5" y2="371"></line>
</g>
<g class="grid y-grid" id="yGrid">
  <line x1="90" x2="705" y1="370" y2="370"></line>
</g>
  <g class="labels x-labels">
  <text x="100" y="400"><script language="JavaScript">document.write(onedayAgo);</script></text>
  <text x="246" y="400"><script language="JavaScript">document.write(twoDaysAgo);</script></text>
  <text x="392" y="400"><script language="JavaScript">document.write(threeDaysAgo);</script></text>
  <text x="538" y="400"><script language="JavaScript">document.write(fourDaysAgo);</script></text>
  <text x="684" y="400"><script language="JavaScript">document.write(fiveDaysAgo);</script></text>
  <text x="400" y="440" class="label-title">Ziua</text>
</g>
<g class="labels y-labels">
  <text x="80" y="15">50.000 lei</text>
  <text x="80" y="131">5000 lei</text>
  <text x="80" y="248">500 lei</text>
  <text x="80" y="373">0 lei</text>
  <text x="50" y="200" class="label-title">Suma</text>
</g>
<g class="data" data-setname="Our first data set">
  <circle cx="90" cy="192" data-value=<?php echo $fiveDaysAgoBets ?> r="5"></circle>
  <circle cx="240" cy="141" data-value=<?php echo $fourDaysAgoBets ?> r="5"></circle>
  <circle cx="388" cy="179" data-value=<?php echo $threeDaysAgoBets ?> r="5"></circle>
  <circle cx="531" cy="200" data-value=<?php echo $twoDaysAgoBets ?> r="5"></circle>
  <circle cx="677" cy="104" data-value=<?php echo $oneDayAgoBets ?> r="5"></circle>
</g>
</svg>

<?php
	require('pages/footer.php');
?>


</body>
</html>
