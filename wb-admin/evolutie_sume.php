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
oneDayAgo=myDays[(todayDate+6)%7]

//-->
</script>

<?php
	$connection = mysqli_connect('localhost', 'root', '', 'worsiebet');
	$res = mysqli_query($connection,"SELECT sum(suma_depusa) FROM bilete WHERE DATE(data_creare) = DATE(subdate(CURRENT_DATE,1)) ");
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
	//0 si 50.000 lei sunt celelalte puncte de referinta 
	//am aflat mai sus cat s-a jucat in ziua x, dupa care vad cat la suta din total reprezinta, anume x/100*50.000=suma noastra
	//dupa ce am aflat procentul, acelasi procent va fi valabil si pentru grafic intre 5 si 370, pentru pozitionare
	//5 e cel mai sus, 370 e cel mai jos
	
	$procent=$oneDayAgoBets/50000*100;
	if($procent==0) {
		$position1=370;
	}
	else {
		$procent=100-$procent;
		$position1=$procent/100*370;
	}

	$procent=$twoDaysAgoBets/50000*100;
	if($procent==0) {
		$position2=370;
	}
	else {
		$procent=100-$procent;
		$position2=$procent/100*370;
	}
	
	$procent=$threeDaysAgoBets/50000*100;
	if($procent==0) {
		$position3=370;
	}
	else {
		$procent=100-$procent;
		$position3=$procent/100*370;
	}
	
	$procent=$fourDaysAgoBets/50000*100;
	if($procent==0) {
		$position4=370;
	}
	else {
		$procent=100-$procent;
		$position4=$procent/100*370;
	}
	
	$procent=$fiveDaysAgoBets/50000*100;
	if($procent==0) {
		$position5=370;
	}
	else {
		$procent=100-$procent;
		$position5=$procent/100*370;
	}
?>

<svg version="1.2" class="graph" role="img">

<g class="grid x-grid" id="xGrid">
  <line x1="90" x2="90" y1="5" y2="371"></line>
</g>
<g class="grid y-grid" id="yGrid">
  <line x1="90" x2="705" y1="370" y2="370"></line>
</g>
  <g class="labels x-labels">
  <text x="100" y="400"><script language="JavaScript">document.write(fiveDaysAgo);</script></text>
  <text x="246" y="400"><script language="JavaScript">document.write(fourDaysAgo);</script></text>
  <text x="392" y="400"><script language="JavaScript">document.write(threeDaysAgo);</script></text>
  <text x="538" y="400"><script language="JavaScript">document.write(twoDaysAgo);</script></text>
  <text x="684" y="400"><script language="JavaScript">document.write(oneDayAgo);</script></text>
  <text x="400" y="440" class="label-title">Ziua</text>
</g>
<g class="labels y-labels">
  <text x="80" y="15">50.000 lei</text>
  <text x="80" y="131">34.000 lei</text>
  <text x="80" y="248">17.000 lei</text>
  <text x="80" y="373">0 lei</text>
  <text x="43" y="200" class="label-title">Suma</text>
</g>
<g class="data" data-setname="Our first data set">
  <circle cx="90" cy="<?php echo $position5?>" data-value=<?php echo $fiveDaysAgoBets ?> r="5"></circle>
  <circle cx="240" cy="<?php echo $position4?>" data-value=<?php echo $fourDaysAgoBets ?> r="5"></circle>
  <circle cx="388" cy="<?php echo $position3?>" data-value=<?php echo $threeDaysAgoBets ?> r="5"></circle>
  <circle cx="531" cy="<?php echo $position2?>" data-value=<?php echo $twoDaysAgoBets ?> r="5"></circle>
  <circle cx="677" cy="<?php echo $position1?>" data-value=<?php echo $oneDayAgoBets ?> r="5"></circle>
</g>
	<line x1="90" y1="<?php echo $position5?>" x2="240" y2="<?php echo $position4?>" stroke-width="3" stroke="red"/>
	<line x1="240" y1="<?php echo $position4?>" x2="388" y2="<?php echo $position3?>" stroke-width="3" stroke="red"/>
	<line x1="388" y1="<?php echo $position3?>" x2="531" y2="<?php echo $position2?>" stroke-width="3" stroke="red"/>
	<line x1="531" y1="<?php echo $position2?>" x2="677" y2="<?php echo $position1?>" stroke-width="3" stroke="red"/>
</svg>

<?php
	require('pages/footer.php');
?>


</body>
</html>
