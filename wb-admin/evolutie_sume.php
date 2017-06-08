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
daysAgo5=myDays[(todayDate+2)%7]
daysAgo4=myDays[(todayDate+3)%7]
daysAgo3=myDays[(todayDate+4)%7]
daysAgo2=myDays[(todayDate+5)%7]
daysAgo1=myDays[(todayDate+6)%7]

//-->
</script>


<svg version="1.2" class="graph" role="img">

<g class="grid x-grid" id="xGrid">
  <line x1="90" x2="90" y1="5" y2="371"></line>
</g>
<g class="grid y-grid" id="yGrid">
  <line x1="90" x2="705" y1="370" y2="370"></line>
</g>
  <g class="labels x-labels">
  <text x="100" y="400"><script language="JavaScript">document.write(daysAgo5);</script></text>
  <text x="246" y="400"><script language="JavaScript">document.write(daysAgo4);</script></text>
  <text x="392" y="400"><script language="JavaScript">document.write(daysAgo3);</script></text>
  <text x="538" y="400"><script language="JavaScript">document.write(daysAgo2);</script></text>
  <text x="684" y="400"><script language="JavaScript">document.write(daysAgo1);</script></text>
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
  <circle cx="90" cy="192" data-value="7.2" r="4"></circle>
  <circle cx="240" cy="141" data-value="8.1" r="4"></circle>
  <circle cx="388" cy="179" data-value="7.7" r="4"></circle>
  <circle cx="531" cy="200" data-value="6.8" r="4"></circle>
  <circle cx="677" cy="104" data-value="6.7" r="4"></circle>
</g>
</svg>

<?php
	require('pages/footer.php');
?>


</body>
</html>
